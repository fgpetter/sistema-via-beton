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
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use SweetAlert2\Laravel\Swal;
use Tests\TestCase;

class OcorrenciasImportTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
    }

    public function test_import_creates_ocorrencias_from_spreadsheet(): void
    {
        $prazo = Prazo::create(['nome' => 'Engenharia.Emergencial', 'prazo_valor' => 6, 'prazo_unidade' => 'hora']);

        $path = $this->createTestExcel(
            ['Nº da ocorrência', 'Resumo', 'Categoria', 'Usuario final afetado', 'Data de abertura'],
            [
                [10001, 'Vazamento no teto', 'Engenharia.Emergencial', 'Agência Centro', '2026-01-15'],
                [10002, 'Infiltração parede', '', 'Agência Norte', '2026-02-20'],
            ]
        );

        $import = new OcorrenciasImport;
        Excel::import($import, $path);

        $this->assertDatabaseHas('ocorrencias', [
            'numero_ocorrencia' => 10001,
            'titulo' => 'Vazamento no teto',
            'prazo_id' => $prazo->id,
            'agencia' => 'Agência Centro',
        ]);
        $this->assertDatabaseHas('ocorrencias', [
            'numero_ocorrencia' => 10002,
            'titulo' => 'Infiltração parede',
            'prazo_id' => null,
            'agencia' => 'Agência Norte',
        ]);
        $this->assertEquals(2, $import->getImportedCount());
        $this->assertEquals(0, $import->getSkippedCount());

        unlink($path);
    }

    public function test_import_skips_rows_with_duplicate_numero_in_file(): void
    {
        $path = $this->createTestExcel(
            ['Nº da ocorrência', 'Resumo', 'Usuario final afetado', 'Data de abertura'],
            [
                [20001, 'Primeira', 'Agência A', '2026-01-15'],
                [20001, 'Duplicada', 'Agência B', '2026-02-20'],
                [20002, 'Terceira', 'Agência C', '2026-03-10'],
            ]
        );

        $import = new OcorrenciasImport;
        Excel::import($import, $path);

        $this->assertEquals(2, Ocorrencia::count());
        $this->assertDatabaseHas('ocorrencias', [
            'numero_ocorrencia' => 20001,
            'titulo' => 'Primeira',
        ]);
        $this->assertDatabaseMissing('ocorrencias', ['titulo' => 'Duplicada']);
        $this->assertEquals(2, $import->getImportedCount());
        $this->assertEquals(1, $import->getSkippedCount());

        unlink($path);
    }

    public function test_import_skips_rows_already_existing_in_database(): void
    {
        Ocorrencia::factory()->create([
            'numero_ocorrencia' => 30001,
            'titulo' => 'Existente',
        ]);

        $path = $this->createTestExcel(
            ['Nº da ocorrência', 'Resumo', 'Usuario final afetado', 'Data de abertura'],
            [
                [30001, 'Duplicada do banco', 'Agência X', '2026-01-15'],
                [30002, 'Nova ocorrência', 'Agência Y', '2026-02-20'],
            ]
        );

        $import = new OcorrenciasImport;
        Excel::import($import, $path);

        $this->assertEquals(2, Ocorrencia::count());
        $this->assertDatabaseHas('ocorrencias', [
            'numero_ocorrencia' => 30001,
            'titulo' => 'Existente',
        ]);
        $this->assertDatabaseHas('ocorrencias', [
            'numero_ocorrencia' => 30002,
            'titulo' => 'Nova ocorrência',
        ]);
        $this->assertEquals(1, $import->getImportedCount());
        $this->assertEquals(1, $import->getSkippedCount());

        unlink($path);
    }

    public function test_import_skips_rows_with_empty_numero_ocorrencia(): void
    {
        $path = $this->createTestExcel(
            ['Nº da ocorrência', 'Resumo', 'Usuario final afetado', 'Data de abertura'],
            [
                ['', 'Sem número', 'Agência Z', '2026-01-15'],
                [40001, 'Com número', 'Agência W', '2026-02-20'],
            ]
        );

        $import = new OcorrenciasImport;
        Excel::import($import, $path);

        $this->assertEquals(1, Ocorrencia::count());
        $this->assertDatabaseHas('ocorrencias', ['numero_ocorrencia' => 40001]);
        $this->assertEquals(1, $import->getImportedCount());
        $this->assertEquals(1, $import->getSkippedCount());

        unlink($path);
    }

    public function test_imported_ocorrencias_have_aberto_status(): void
    {
        $path = $this->createTestExcel(
            ['Nº da ocorrência', 'Resumo', 'Usuario final afetado', 'Data de abertura'],
            [
                [50001, 'Teste status', 'Agência T', '2026-01-15'],
            ]
        );

        $import = new OcorrenciasImport;
        Excel::import($import, $path);

        $ocorrencia = Ocorrencia::find(50001);
        $this->assertEquals(OcorrenciaStatus::Aberto, $ocorrencia->status);

        unlink($path);
    }

    public function test_livewire_import_succeeds_with_valid_file(): void
    {
        $path = $this->createTestExcel(
            ['Nº da ocorrência', 'Resumo', 'Usuario final afetado', 'Data de abertura'],
            [
                [60001, 'Via Livewire', 'Agência LW', '2026-03-01'],
            ]
        );

        $file = UploadedFile::fake()->createWithContent('import.xlsx', file_get_contents($path));

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('importFile', $file)
            ->assertHasNoErrors()
            ->assertDispatched(Swal::SESSION_KEY, function (string $event, array $params): bool {
                return str_contains($params['title'] ?? '', '1 importada(s)')
                    && ($params['icon'] ?? '') === 'success';
            });

        $this->assertDatabaseHas('ocorrencias', ['numero_ocorrencia' => 60001]);

        unlink($path);
    }

    public function test_livewire_import_shows_warning_when_skipped(): void
    {
        Ocorrencia::factory()->create(['numero_ocorrencia' => 70001]);

        $path = $this->createTestExcel(
            ['Nº da ocorrência', 'Resumo', 'Usuario final afetado', 'Data de abertura'],
            [
                [70001, 'Duplicada', 'Agência Dup', '2026-03-01'],
                [70002, 'Nova', 'Agência Nova', '2026-03-01'],
            ]
        );

        $file = UploadedFile::fake()->createWithContent('import.xlsx', file_get_contents($path));

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('importFile', $file)
            ->assertHasNoErrors()
            ->assertDispatched(Swal::SESSION_KEY, function (string $event, array $params): bool {
                return str_contains($params['title'] ?? '', '1 ignorada(s)')
                    && ($params['icon'] ?? '') === 'warning';
            });

        $this->assertDatabaseHas('ocorrencias', ['numero_ocorrencia' => 70002]);

        unlink($path);
    }

    public function test_numero_ocorrencia_is_primary_key_and_unique(): void
    {
        Ocorrencia::factory()->create(['numero_ocorrencia' => 99999]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        Ocorrencia::create([
            'numero_ocorrencia' => 99999,
            'titulo' => 'Duplicada',
            'agencia' => 'Teste',
            'abertura' => now(),
            'status' => OcorrenciaStatus::Aberto->value,
        ]);
    }

    /**
     * @param  list<string>  $headers
     * @param  list<list<mixed>>  $rows
     */
    private function createTestExcel(array $headers, array $rows): string
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($headers as $col => $header) {
            $sheet->setCellValue([$col + 1, 1], $header);
        }

        foreach ($rows as $rowIndex => $row) {
            foreach ($row as $col => $value) {
                $sheet->setCellValue([$col + 1, $rowIndex + 2], $value);
            }
        }

        $path = storage_path('app/test-import-'.uniqid().'.xlsx');
        (new Xlsx($spreadsheet))->save($path);

        return $path;
    }
}
