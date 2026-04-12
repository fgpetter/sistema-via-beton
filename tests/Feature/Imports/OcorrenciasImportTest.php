<?php

namespace Tests\Feature\Imports;

use App\Enums\OcorrenciaStatus;
use App\Imports\OcorrenciasImport;
use App\Livewire\Admin\OcorrenciasList;
use App\Models\Ocorrencia;
use App\Models\Prazo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Tests\TestCase;

class OcorrenciasImportTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private string $testFilePath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        $this->testFilePath = storage_path('app/private/test-import-'.uniqid().'.xlsx');
    }

    protected function tearDown(): void
    {
        if (file_exists($this->testFilePath)) {
            unlink($this->testFilePath);
        }

        parent::tearDown();
    }

    public function test_import_creates_ocorrencias_from_excel(): void
    {
        $this->createTestExcel([
            ['9498549', 'Em andamento', Date::PHPToExcel(new \DateTime('2026-01-15')), 'Engenharia.Emergencial', 'AG FORMIGUEIRO', 'Infiltrações no teto', 'Descrição teste'],
            ['9490683', 'Em andamento', Date::PHPToExcel(new \DateTime('2026-02-10')), '', 'AG AGUDO', 'Caixa de gordura entupida', 'Outra descrição'],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $this->assertEquals(2, $import->getImportedCount());
        $this->assertEquals(0, $import->getSkippedCount());
        $this->assertDatabaseCount('ocorrencias', 2);

        $this->assertDatabaseHas('ocorrencias', [
            'id' => 9498549,
            'titulo' => 'Infiltrações no teto',
            'agencia' => 'AG FORMIGUEIRO',
            'status' => OcorrenciaStatus::Andamento->value,
        ]);
    }

    public function test_import_skips_rows_without_titulo(): void
    {
        $this->createTestExcel([
            ['9498549', 'Em andamento', Date::PHPToExcel(new \DateTime('2026-01-15')), '', 'AG FORMIGUEIRO', '', 'Descrição'],
            ['9490683', 'Em andamento', Date::PHPToExcel(new \DateTime('2026-02-10')), '', 'AG AGUDO', 'Titulo válido', ''],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $this->assertEquals(1, $import->getImportedCount());
        $this->assertEquals(1, $import->getSkippedCount());
        $this->assertDatabaseCount('ocorrencias', 1);
        $this->assertDatabaseHas('ocorrencias', ['titulo' => 'Titulo válido']);
    }

    public function test_import_skips_rows_without_agencia(): void
    {
        $this->createTestExcel([
            ['9498549', 'Em andamento', Date::PHPToExcel(new \DateTime('2026-01-15')), '', '', 'Titulo teste', 'Descrição'],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $this->assertEquals(0, $import->getImportedCount());
        $this->assertEquals(1, $import->getSkippedCount());
        $this->assertDatabaseCount('ocorrencias', 0);
    }

    public function test_import_skips_completely_empty_rows(): void
    {
        $this->createTestExcel([
            ['9498549', 'Em andamento', Date::PHPToExcel(new \DateTime('2026-01-15')), '', 'AG FORMIGUEIRO', 'Titulo', 'Desc'],
            ['', '', '', '', '', '', ''],
            [null, null, null, null, null, null, null],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $this->assertEquals(1, $import->getImportedCount());
        $this->assertDatabaseCount('ocorrencias', 1);
    }

    public function test_import_maps_status_correctly(): void
    {
        $this->createTestExcel([
            ['1', 'Em andamento', Date::PHPToExcel(new \DateTime('2026-01-15')), '', 'AG A', 'Titulo A', ''],
            ['2', 'Em espera', Date::PHPToExcel(new \DateTime('2026-01-15')), '', 'AG B', 'Titulo B', ''],
            ['3', '', Date::PHPToExcel(new \DateTime('2026-01-15')), '', 'AG C', 'Titulo C', ''],
            ['4', 'Concluído', Date::PHPToExcel(new \DateTime('2026-01-15')), '', 'AG D', 'Titulo D', ''],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $this->assertDatabaseHas('ocorrencias', ['id' => 1, 'status' => OcorrenciaStatus::Andamento->value]);
        $this->assertDatabaseHas('ocorrencias', ['id' => 2, 'status' => OcorrenciaStatus::Aberto->value]);
        $this->assertDatabaseHas('ocorrencias', ['id' => 3, 'status' => OcorrenciaStatus::Aberto->value]);
        $this->assertDatabaseHas('ocorrencias', ['id' => 4, 'status' => OcorrenciaStatus::Concluido->value]);
    }

    public function test_import_converts_excel_serial_dates(): void
    {
        $excelDate = Date::PHPToExcel(new \DateTime('2026-03-01'));

        $this->createTestExcel([
            ['1', '', $excelDate, '', 'AG A', 'Titulo', ''],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $this->assertDatabaseHas('ocorrencias', [
            'id' => 1,
            'abertura' => '2026-03-01',
        ]);
    }

    public function test_import_matches_prazo_by_category_case_insensitive(): void
    {
        $prazo = Prazo::firstOrCreate(
            ['nome' => 'Engenharia.Manutenção Corretiva'],
            ['prazo_valor' => 20, 'prazo_unidade' => 'dia']
        );

        $this->createTestExcel([
            ['1', '', Date::PHPToExcel(new \DateTime('2026-01-15')), 'Engenharia.Manutenção corretiva', 'AG A', 'Titulo', ''],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $this->assertDatabaseHas('ocorrencias', [
            'id' => 1,
            'prazo_id' => $prazo->id,
        ]);
    }

    public function test_import_sets_defaults_for_blank_optional_fields(): void
    {
        $this->freezeTime();

        $this->createTestExcel([
            ['1', '', '', '', 'AG A', 'Titulo', ''],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $ocorrencia = Ocorrencia::find(1);

        $this->assertNotNull($ocorrencia);
        $this->assertNull($ocorrencia->descricao);
        $this->assertEquals(now()->format('Y-m-d'), $ocorrencia->abertura->format('Y-m-d'));
        $this->assertNull($ocorrencia->prazo_id);
        $this->assertNull($ocorrencia->violacao_projetada);
        $this->assertNull($ocorrencia->contrato);
        $this->assertNull($ocorrencia->prioridade);
    }

    public function test_import_maps_violacao_contrato_prioridade(): void
    {
        $violacaoExcel = Date::PHPToExcel(new \DateTime('2026-06-01 14:30:00'));

        $this->createTestExcel([
            [
                '1',
                '',
                Date::PHPToExcel(new \DateTime('2026-01-15')),
                '',
                'AG A',
                'Titulo',
                'Desc',
                $violacaoExcel,
                'VIA BETON - Sureg Fronteira',
                'Alta',
            ],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $ocorrencia = Ocorrencia::find(1);

        $this->assertNotNull($ocorrencia);
        $this->assertSame('0100557/2025', $ocorrencia->contrato);
        $this->assertSame('Alta', $ocorrencia->prioridade);
        $this->assertNotNull($ocorrencia->violacao_projetada);
        $this->assertSame('2026-06-01 14:30:00', $ocorrencia->violacao_projetada->format('Y-m-d H:i:s'));
    }

    public function test_livewire_import_requires_admin(): void
    {
        $prestador = User::factory()->prestador()->create();

        Livewire::actingAs($prestador)
            ->test(OcorrenciasList::class)
            ->call('importOcorrencias')
            ->assertForbidden();
    }

    public function test_livewire_import_validates_file_required(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('importOcorrencias')
            ->assertHasErrors(['importFile']);
    }

    public function test_livewire_import_validates_file_type(): void
    {
        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('importFile', $file)
            ->call('importOcorrencias')
            ->assertHasErrors(['importFile']);
    }

    public function test_livewire_import_succeeds_with_valid_file(): void
    {
        $this->createTestExcel([
            ['9498549', 'Em andamento', Date::PHPToExcel(new \DateTime('2026-01-15')), '', 'AG FORMIGUEIRO', 'Infiltrações no teto', 'Descrição'],
        ]);

        $file = UploadedFile::fake()->createWithContent(
            'import.xlsx',
            file_get_contents($this->testFilePath)
        );

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('importFile', $file);

        $this->assertDatabaseHas('ocorrencias', [
            'id' => 9498549,
            'titulo' => 'Infiltrações no teto',
        ]);
    }

    public function test_import_skips_duplicate_ids(): void
    {
        $this->createTestExcel([
            ['123', 'Em andamento', Date::PHPToExcel(new \DateTime('2026-01-15')), '', 'AG A', 'Titulo A', 'Descrição A'],
            ['123', 'Concluído', Date::PHPToExcel(new \DateTime('2026-02-10')), '', 'AG B', 'Titulo B', 'Descrição B'],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $this->assertEquals(1, $import->getImportedCount());
        $this->assertEquals(1, $import->getSkippedCount());
        $this->assertDatabaseCount('ocorrencias', 1);
        $this->assertDatabaseHas('ocorrencias', [
            'id' => 123,
            'titulo' => 'Titulo A',
            'agencia' => 'AG A',
        ]);
    }

    /**
     * @param  array<int, array<int, mixed>>  $rows
     */
    private function createTestExcel(array $rows): void
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'Nº da ocorrência', 'Status', 'Data de abertura', 'Categoria',
            'Usuário final afetado', 'Resumo', 'Descricao',
            'Violação Projetada', 'Grupo Solucionador', 'Prioridade',
        ];

        foreach ($headers as $col => $header) {
            $sheet->setCellValue([$col + 1, 1], $header);
        }

        $columnCount = count($headers);

        foreach ($rows as $rowIndex => $row) {
            $padded = array_pad(array_values($row), $columnCount, null);

            foreach ($padded as $col => $value) {
                $sheet->setCellValue([$col + 1, $rowIndex + 2], $value);
            }
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($this->testFilePath);
    }
}
