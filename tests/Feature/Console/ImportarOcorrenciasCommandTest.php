<?php

use App\Mail\ImportacaoOcorrenciasConcluida;
use App\Mail\ImportacaoOcorrenciasFalhou;
use App\Models\Ocorrencia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function (): void {
    Mail::fake();

    $this->pasta = storage_path('app/private/importar-ocorrencias-'.uniqid());
    $this->importLogPath = storage_path('logs/importcommand.log');
    File::ensureDirectoryExists($this->pasta);

    if (file_exists($this->importLogPath)) {
        unlink($this->importLogPath);
    }
});

afterEach(function (): void {
    if (isset($this->pasta) && File::isDirectory($this->pasta)) {
        File::deleteDirectory($this->pasta);
    }

    if (isset($this->importLogPath) && file_exists($this->importLogPath)) {
        unlink($this->importLogPath);
    }
});

test('pasta inexistente termina com sucesso sem e-mail nem registros', function (): void {
    $this->artisan('ocorrencias:importar', ['--pasta' => $this->pasta.'/ausente'])
        ->assertSuccessful();

    Mail::assertNothingOutgoing();
    $this->assertDatabaseCount('ocorrencias', 0);
});

test('pasta sem xlsx termina com sucesso sem e-mail nem registros', function (): void {
    $this->artisan('ocorrencias:importar', ['--pasta' => $this->pasta])
        ->assertSuccessful();

    Mail::assertNothingOutgoing();
    $this->assertDatabaseCount('ocorrencias', 0);
});

test('xlsx novo cria ocorrencias apaga arquivos e enfileira e-mail de sucesso', function (): void {
    $caminho = $this->pasta.'/novo.xlsx';
    gravarPlanilhaOcorrencias($caminho, [
        ['9100001', 'Em andamento', Date::PHPToExcel(new DateTime('2026-01-15')), '', 'AG FORMIGUEIRO', 'Infiltrações no teto', 'Descrição'],
    ]);

    $this->artisan('ocorrencias:importar', ['--pasta' => $this->pasta])
        ->expectsOutputToContain('Arquivo: novo.xlsx')
        ->expectsOutputToContain('Importadas: 1')
        ->expectsOutputToContain('Linhas ignoradas: 0')
        ->assertSuccessful();

    $this->assertDatabaseHas('ocorrencias', [
        'id' => 9100001,
        'titulo' => 'Infiltrações no teto',
    ]);
    $this->assertFileDoesNotExist($caminho);
    Mail::assertQueued(ImportacaoOcorrenciasConcluida::class, function (ImportacaoOcorrenciasConcluida $mail): bool {
        return $mail->hasTo('fabio@vbeton.com.br')
            && $mail->hasCc('fgpetter@gmail.com')
            && $mail->arquivo === 'novo.xlsx'
            && $mail->importadas === 1
            && $mail->linhasIgnoradas === 0;
    });
    Mail::assertNotQueued(ImportacaoOcorrenciasFalhou::class);
});

test('somente ids existentes apaga xlsx e nao envia e-mail', function (): void {
    Ocorrencia::factory()->create(['id' => 9100002]);

    $caminho = $this->pasta.'/duplicado.xlsx';
    gravarPlanilhaOcorrencias($caminho, [
        ['9100002', 'Em andamento', Date::PHPToExcel(new DateTime('2026-01-15')), '', 'AG A', 'Titulo A', ''],
    ]);

    $this->artisan('ocorrencias:importar', ['--pasta' => $this->pasta])
        ->expectsOutputToContain('Importadas: 0')
        ->expectsOutputToContain('Linhas ignoradas: 1')
        ->assertSuccessful();

    $this->assertDatabaseCount('ocorrencias', 1);
    $this->assertFileDoesNotExist($caminho);
    Mail::assertNothingOutgoing();
});

test('dois arquivos so o mais recente gera ocorrencias e ambos sao apagados', function (): void {
    $antigo = $this->pasta.'/antigo.xlsx';
    $recente = $this->pasta.'/recente.xlsx';

    gravarPlanilhaOcorrencias($antigo, [
        ['9100003', 'Em andamento', Date::PHPToExcel(new DateTime('2026-01-15')), '', 'AG ANTIGA', 'Titulo antigo', ''],
    ]);
    gravarPlanilhaOcorrencias($recente, [
        ['9100004', 'Em andamento', Date::PHPToExcel(new DateTime('2026-02-10')), '', 'AG NOVA', 'Titulo recente', ''],
    ]);

    touch($antigo, time() - 120);
    touch($recente, time());

    $this->artisan('ocorrencias:importar', ['--pasta' => $this->pasta])
        ->expectsOutputToContain('Arquivo: recente.xlsx')
        ->assertSuccessful();

    $this->assertDatabaseHas('ocorrencias', [
        'id' => 9100004,
        'titulo' => 'Titulo recente',
    ]);
    $this->assertDatabaseMissing('ocorrencias', ['id' => 9100003]);
    $this->assertFileDoesNotExist($antigo);
    $this->assertFileDoesNotExist($recente);
    Mail::assertQueued(ImportacaoOcorrenciasConcluida::class, function (ImportacaoOcorrenciasConcluida $mail): bool {
        return $mail->arquivo === 'recente.xlsx' && $mail->importadas === 1;
    });
});

test('importacao que lanca apaga xlsx enfileira falha e sai 1', function (): void {
    $caminho = $this->pasta.'/quebrado.xlsx';
    file_put_contents($caminho, 'nao-e-um-xlsx');

    Excel::shouldReceive('import')
        ->once()
        ->andThrow(new RuntimeException('planilha inválida'));

    $this->artisan('ocorrencias:importar', ['--pasta' => $this->pasta])
        ->expectsOutputToContain('planilha inválida')
        ->assertExitCode(1);

    $this->assertFileDoesNotExist($caminho);
    $this->assertDatabaseCount('ocorrencias', 0);
    $this->assertFileExists($this->importLogPath);
    $conteudoLog = (string) file_get_contents($this->importLogPath);
    expect($conteudoLog)
        ->toContain('Falha na importação de ocorrências')
        ->toContain('quebrado.xlsx')
        ->toContain('planilha inválida')
        ->toContain(RuntimeException::class);
    Mail::assertQueued(ImportacaoOcorrenciasFalhou::class, function (ImportacaoOcorrenciasFalhou $mail): bool {
        return $mail->hasTo('fabio@vbeton.com.br')
            && $mail->hasCc('fgpetter@gmail.com')
            && $mail->arquivo === 'quebrado.xlsx'
            && $mail->mensagem === 'planilha inválida';
    });
    Mail::assertNotQueued(ImportacaoOcorrenciasConcluida::class);
});

/**
 * @param  array<int, array<int, mixed>>  $rows
 */
function gravarPlanilhaOcorrencias(string $path, array $rows): void
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
    $writer->save($path);
}
