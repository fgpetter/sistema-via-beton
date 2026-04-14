<?php

namespace Tests\Feature;

use App\Enums\TipoEndereco;
use App\Imports\OcorrenciasImport;
use App\Livewire\Admin\OcorrenciaModal;
use App\Models\Endereco;
use App\Models\Ocorrencia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Tests\TestCase;

class EnderecoOcorrenciaRelacionamentoTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private string $testFilePath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        $this->testFilePath = storage_path('app/private/test-endereco-import-'.uniqid().'.xlsx');
    }

    protected function tearDown(): void
    {
        if (file_exists($this->testFilePath)) {
            unlink($this->testFilePath);
        }

        parent::tearDown();
    }

    public function test_ocorrencia_belongs_to_endereco_vinculado(): void
    {
        $endereco = Endereco::create([
            'nome' => 'AG TESTE',
            'tipo' => TipoEndereco::AGENCIA,
            'numero' => '999',
            'horario' => '10:00-15:00',
            'endereco' => 'Rua Teste, 123',
            'cidade_estado' => 'Teste/RS',
            'fone' => '(51) 1234-5678',
            'ativo' => true,
        ]);

        $ocorrencia = Ocorrencia::factory()->create([
            'agencia' => 'AG TESTE',
            'endereco_id' => $endereco->id,
        ]);

        $this->assertNotNull($ocorrencia->enderecoVinculado);
        $this->assertEquals($endereco->id, $ocorrencia->enderecoVinculado->id);
        $this->assertEquals('AG TESTE', $ocorrencia->enderecoVinculado->nome);
        $this->assertEquals('999', $ocorrencia->enderecoVinculado->numero);
    }

    public function test_endereco_has_many_ocorrencias(): void
    {
        $endereco = Endereco::create([
            'nome' => 'AG TESTE',
            'tipo' => TipoEndereco::AGENCIA,
            'numero' => '999',
            'horario' => '10:00-15:00',
            'endereco' => 'Rua Teste, 123',
            'cidade_estado' => 'Teste/RS',
            'fone' => '(51) 1234-5678',
            'ativo' => true,
        ]);

        Ocorrencia::factory()->count(3)->create([
            'agencia' => 'AG TESTE',
            'endereco_id' => $endereco->id,
        ]);

        $this->assertCount(3, $endereco->ocorrencias);
    }

    public function test_ocorrencia_sem_endereco_vinculado_retorna_null(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'endereco_id' => null,
        ]);

        $this->assertNull($ocorrencia->enderecoVinculado);
    }

    public function test_resolver_endereco_id_encontra_por_nome_exato(): void
    {
        $endereco = Endereco::create([
            'nome' => 'AG AGUDO',
            'tipo' => TipoEndereco::AGENCIA,
            'numero' => '102',
            'horario' => '10:00-15:00',
            'endereco' => 'AV CONCORDIA, 735',
            'cidade_estado' => 'AGUDO/RS',
            'fone' => '(55) 3265-7100',
            'ativo' => true,
        ]);

        $result = Ocorrencia::resolverEnderecoId('AG AGUDO');

        $this->assertEquals($endereco->id, $result);
    }

    public function test_resolver_endereco_id_case_insensitive(): void
    {
        $endereco = Endereco::create([
            'nome' => 'AG AGUDO',
            'tipo' => TipoEndereco::AGENCIA,
            'numero' => '102',
            'horario' => '10:00-15:00',
            'endereco' => 'AV CONCORDIA, 735',
            'cidade_estado' => 'AGUDO/RS',
            'fone' => '(55) 3265-7100',
            'ativo' => true,
        ]);

        $result = Ocorrencia::resolverEnderecoId('ag agudo');

        $this->assertEquals($endereco->id, $result);
    }

    public function test_resolver_endereco_id_retorna_null_quando_nao_encontra(): void
    {
        $result = Ocorrencia::resolverEnderecoId('AG INEXISTENTE');

        $this->assertNull($result);
    }

    public function test_resolver_endereco_id_retorna_null_para_null(): void
    {
        $this->assertNull(Ocorrencia::resolverEnderecoId(null));
    }

    public function test_import_vincula_endereco_id_pelo_nome_da_agencia(): void
    {
        $endereco = Endereco::create([
            'nome' => 'AG FORMIGUEIRO',
            'tipo' => TipoEndereco::AGENCIA,
            'numero' => '16',
            'horario' => '10:00-15:00',
            'endereco' => 'Rua João Pessoa, 120',
            'cidade_estado' => 'Formigueiro/RS',
            'fone' => '(55) 3231-2500',
            'ativo' => true,
        ]);

        $this->createTestExcel([
            ['9498549', 'Em andamento', Date::PHPToExcel(new \DateTime('2026-01-15')), '', 'AG FORMIGUEIRO', 'Infiltrações no teto', 'Descrição teste'],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $ocorrencia = Ocorrencia::where('id', 9498549)->first();

        $this->assertNotNull($ocorrencia);
        $this->assertEquals($endereco->id, $ocorrencia->endereco_id);
        $this->assertEquals('AG FORMIGUEIRO', $ocorrencia->agencia);
    }

    public function test_import_deixa_endereco_id_null_quando_agencia_nao_encontrada(): void
    {
        $this->createTestExcel([
            ['1', 'Em andamento', Date::PHPToExcel(new \DateTime('2026-01-15')), '', 'AG DESCONHECIDA', 'Titulo teste', 'Descrição'],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $ocorrencia = Ocorrencia::where('id', 1)->first();

        $this->assertNotNull($ocorrencia);
        $this->assertNull($ocorrencia->endereco_id);
    }

    public function test_import_vincula_multiplas_ocorrencias_ao_mesmo_endereco(): void
    {
        Endereco::create([
            'nome' => 'AG AGUDO',
            'tipo' => TipoEndereco::AGENCIA,
            'numero' => '102',
            'horario' => '10:00-15:00',
            'endereco' => 'AV CONCORDIA, 735',
            'cidade_estado' => 'AGUDO/RS',
            'fone' => '(55) 3265-7100',
            'ativo' => true,
        ]);

        $this->createTestExcel([
            ['1', '', Date::PHPToExcel(new \DateTime('2026-01-15')), '', 'AG AGUDO', 'Problema 1', ''],
            ['2', '', Date::PHPToExcel(new \DateTime('2026-01-16')), '', 'AG AGUDO', 'Problema 2', ''],
        ]);

        $import = new OcorrenciasImport;
        $import->import($this->testFilePath);

        $this->assertEquals(2, $import->getImportedCount());

        $oc1 = Ocorrencia::find(1);
        $oc2 = Ocorrencia::find(2);

        $this->assertNotNull($oc1->endereco_id);
        $this->assertEquals($oc1->endereco_id, $oc2->endereco_id);
    }

    public function test_livewire_save_resolve_endereco_id_pelo_nome_da_agencia(): void
    {
        $endereco = Endereco::create([
            'nome' => 'AG TESTE LIVEWIRE',
            'tipo' => TipoEndereco::AGENCIA,
            'numero' => '500',
            'horario' => '10:00-15:00',
            'endereco' => 'Rua Teste, 100',
            'cidade_estado' => 'Teste/RS',
            'fone' => '(51) 9999-9999',
            'ativo' => true,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Ocorrência de teste')
            ->set('form.agencia', 'AG TESTE LIVEWIRE')
            ->set('form.abertura', now()->format('Y-m-d'))
            ->set('form.status', 'aberto')
            ->call('save');

        $ocorrencia = Ocorrencia::where('titulo', 'Ocorrência de teste')->first();

        $this->assertNotNull($ocorrencia);
        $this->assertEquals($endereco->id, $ocorrencia->endereco_id);
    }

    public function test_livewire_save_deixa_endereco_id_null_quando_agencia_nao_encontrada(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Ocorrência sem endereco')
            ->set('form.agencia', 'AG NAO EXISTE')
            ->set('form.abertura', now()->format('Y-m-d'))
            ->set('form.status', 'aberto')
            ->call('save');

        $ocorrencia = Ocorrencia::where('titulo', 'Ocorrência sem endereco')->first();

        $this->assertNotNull($ocorrencia);
        $this->assertNull($ocorrencia->endereco_id);
    }

    public function test_deletar_endereco_seta_endereco_id_null_na_ocorrencia(): void
    {
        $endereco = Endereco::create([
            'nome' => 'AG PARA DELETAR',
            'tipo' => TipoEndereco::AGENCIA,
            'numero' => '888',
            'horario' => '10:00-15:00',
            'endereco' => 'Rua Delete, 1',
            'cidade_estado' => 'Delete/RS',
            'fone' => '(51) 0000-0000',
            'ativo' => true,
        ]);

        $ocorrencia = Ocorrencia::factory()->create([
            'agencia' => 'AG PARA DELETAR',
            'endereco_id' => $endereco->id,
        ]);

        $endereco->delete();
        $ocorrencia->refresh();

        $this->assertNull($ocorrencia->endereco_id);
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
        ];

        foreach ($headers as $col => $header) {
            $sheet->setCellValue([$col + 1, 1], $header);
        }

        foreach ($rows as $rowIndex => $row) {
            foreach ($row as $col => $value) {
                $sheet->setCellValue([$col + 1, $rowIndex + 2], $value);
            }
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($this->testFilePath);
    }
}
