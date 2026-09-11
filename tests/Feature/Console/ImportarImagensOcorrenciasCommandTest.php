<?php

namespace Tests\Feature\Console;

use App\Enums\TipoImagemOcorrencia;
use App\Jobs\ProcessarImagemOcorrencia;
use App\Mail\ImportacaoImagensOcorrenciasConcluida;
use App\Models\Ocorrencia;
use App\Models\OcorrenciaImagem;
use App\Models\OcorrenciaImagemImportacao;
use App\Models\Preventiva;
use App\Models\PreventivaImagem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImportarImagensOcorrenciasCommandTest extends TestCase
{
    use RefreshDatabase;

    private string $pastaTemp;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pastaTemp = storage_path('framework/testing/temp-images-'.uniqid());
        File::ensureDirectoryExists($this->pastaTemp);
    }

    protected function tearDown(): void
    {
        if (File::isDirectory($this->pastaTemp)) {
            File::deleteDirectory($this->pastaTemp);
        }

        parent::tearDown();
    }

    public function test_importa_multiplas_imagens_como_antes_em_novos_pares(): void
    {
        Storage::fake('public');
        Bus::fake();

        $ocorrencia = Ocorrencia::factory()->create();

        $pastaOcorrencia = $this->pastaTemp.'/'.$ocorrencia->id;
        File::ensureDirectoryExists($pastaOcorrencia);
        $this->gravarImagemFake($pastaOcorrencia.'/a.jpg');
        $this->gravarImagemFake($pastaOcorrencia.'/b.png');
        File::put($pastaOcorrencia.'/nota.txt', 'ignorar');

        $this->artisan('ocorrencias:importar-imagens', ['--pasta' => $this->pastaTemp])
            ->expectsOutputToContain('Importadas: 1')
            ->assertSuccessful();

        $this->assertDatabaseCount('ocorrencia_imagens', 2);
        $this->assertDatabaseHas('ocorrencia_imagens', [
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes->value,
            'par' => 1,
        ]);
        $this->assertDatabaseHas('ocorrencia_imagens', [
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes->value,
            'par' => 2,
        ]);

        $importacao = OcorrenciaImagemImportacao::query()
            ->where('ocorrencia_id', $ocorrencia->id)
            ->first();

        $this->assertNotNull($importacao);
        $this->assertSame(OcorrenciaImagemImportacao::STATUS_PROCESSANDO, $importacao->status);
        $this->assertNotNull($importacao->batch_id);

        $imagensImportadas = OcorrenciaImagem::query()
            ->where('ocorrencia_imagem_importacao_id', $importacao->id)
            ->get();

        $this->assertCount(2, $imagensImportadas);

        foreach ($imagensImportadas as $imagem) {
            $this->assertStringStartsWith("ocorrencias/{$ocorrencia->id}/antes/", $imagem->path);
            Storage::disk('public')->assertExists($imagem->path);
        }

        $this->assertFileExists($pastaOcorrencia.'/a.jpg');
        $this->assertFileExists($pastaOcorrencia.'/b.png');

        Bus::assertBatched(function ($batch) {
            return $batch->jobs->count() === 2
                && $batch->jobs->every(fn ($job) => $job instanceof ProcessarImagemOcorrencia);
        });

        $this->assertDatabaseCount('preventiva_imagens', 0);
    }

    public function test_pasta_concluida_nao_reimporta(): void
    {
        Storage::fake('public');
        Bus::fake();

        $ocorrencia = Ocorrencia::factory()->create();
        $pastaOcorrencia = $this->pastaTemp.'/'.$ocorrencia->id;
        File::ensureDirectoryExists($pastaOcorrencia);
        $this->gravarImagemFake($pastaOcorrencia.'/a.jpg');

        $importacao = OcorrenciaImagemImportacao::query()->create([
            'ocorrencia_id' => $ocorrencia->id,
            'status' => OcorrenciaImagemImportacao::STATUS_CONCLUIDA,
            'iniciada_em' => now(),
            'concluida_em' => now(),
        ]);

        OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => "ocorrencias/{$ocorrencia->id}/antes/ja-importada.jpg",
            'ocorrencia_imagem_importacao_id' => $importacao->id,
        ]);

        $this->artisan('ocorrencias:importar-imagens', ['--pasta' => $this->pastaTemp])
            ->expectsOutputToContain('Ignoradas: 1')
            ->assertSuccessful();

        $this->assertDatabaseCount('ocorrencia_imagens', 1);
        Bus::assertNothingBatched();
    }

    public function test_ocorrencia_com_imagem_existente_e_ignorada(): void
    {
        Storage::fake('public');
        Bus::fake();

        $ocorrencia = Ocorrencia::factory()->create();

        OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => "ocorrencias/{$ocorrencia->id}/antes/existente.jpg",
        ]);

        $pastaOcorrencia = $this->pastaTemp.'/'.$ocorrencia->id;
        File::ensureDirectoryExists($pastaOcorrencia);
        $this->gravarImagemFake($pastaOcorrencia.'/a.jpg');

        $this->artisan('ocorrencias:importar-imagens', ['--pasta' => $this->pastaTemp])
            ->expectsOutputToContain('Ignoradas: 1')
            ->assertSuccessful();

        $this->assertDatabaseCount('ocorrencia_imagens', 1);
        $this->assertDatabaseCount('ocorrencia_imagem_importacoes', 0);
        Bus::assertNothingBatched();
    }

    public function test_falha_com_imagem_externa_nao_retoma(): void
    {
        Storage::fake('public');
        Bus::fake();

        $ocorrencia = Ocorrencia::factory()->create();

        $importacao = OcorrenciaImagemImportacao::query()->create([
            'ocorrencia_id' => $ocorrencia->id,
            'status' => OcorrenciaImagemImportacao::STATUS_FALHOU,
            'iniciada_em' => now(),
            'falhou_em' => now(),
        ]);

        OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => "ocorrencias/{$ocorrencia->id}/antes/da-importacao.jpg",
            'ocorrencia_imagem_importacao_id' => $importacao->id,
        ]);

        OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Depois,
            'par' => 1,
            'path' => "ocorrencias/{$ocorrencia->id}/depois/manual.jpg",
        ]);

        $pastaOcorrencia = $this->pastaTemp.'/'.$ocorrencia->id;
        File::ensureDirectoryExists($pastaOcorrencia);
        $this->gravarImagemFake($pastaOcorrencia.'/a.jpg');

        $this->artisan('ocorrencias:importar-imagens', ['--pasta' => $this->pastaTemp])
            ->expectsOutputToContain('Ignoradas: 1')
            ->assertSuccessful();

        $this->assertDatabaseCount('ocorrencia_imagens', 2);
        $importacao->refresh();
        $this->assertSame(OcorrenciaImagemImportacao::STATUS_FALHOU, $importacao->status);
        Bus::assertNothingBatched();
    }

    public function test_retoma_apos_falha_sem_duplicar_imagens(): void
    {
        Storage::fake('public');
        Bus::fake();

        $ocorrencia = Ocorrencia::factory()->create();
        $pastaOcorrencia = $this->pastaTemp.'/'.$ocorrencia->id;
        File::ensureDirectoryExists($pastaOcorrencia);
        $this->gravarImagemFake($pastaOcorrencia.'/a.jpg');
        $this->gravarImagemFake($pastaOcorrencia.'/b.jpg');

        $importacao = OcorrenciaImagemImportacao::query()->create([
            'ocorrencia_id' => $ocorrencia->id,
            'status' => OcorrenciaImagemImportacao::STATUS_FALHOU,
            'iniciada_em' => now(),
            'falhou_em' => now(),
        ]);

        OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => "ocorrencias/{$ocorrencia->id}/antes/um.jpg",
            'ocorrencia_imagem_importacao_id' => $importacao->id,
        ]);
        OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 2,
            'path' => "ocorrencias/{$ocorrencia->id}/antes/dois.jpg",
            'ocorrencia_imagem_importacao_id' => $importacao->id,
        ]);

        $this->artisan('ocorrencias:importar-imagens', ['--pasta' => $this->pastaTemp])
            ->expectsOutputToContain('Importadas: 1')
            ->assertSuccessful();

        $this->assertDatabaseCount('ocorrencia_imagens', 2);
        $importacao->refresh();
        $this->assertSame(OcorrenciaImagemImportacao::STATUS_PROCESSANDO, $importacao->status);
        $this->assertNull($importacao->falhou_em);

        Bus::assertBatched(fn ($batch) => $batch->jobs->count() === 2);
    }

    public function test_id_inexistente_e_extensao_invalida_nao_criam_registros(): void
    {
        Storage::fake('public');
        Bus::fake();

        File::ensureDirectoryExists($this->pastaTemp.'/999999');
        $this->gravarImagemFake($this->pastaTemp.'/999999/a.jpg');

        $ocorrencia = Ocorrencia::factory()->create();
        File::ensureDirectoryExists($this->pastaTemp.'/'.$ocorrencia->id);
        File::put($this->pastaTemp.'/'.$ocorrencia->id.'/nota.txt', 'nao-imagem');

        $this->artisan('ocorrencias:importar-imagens', ['--pasta' => $this->pastaTemp])
            ->expectsOutputToContain('Erros: 2')
            ->assertSuccessful();

        $this->assertDatabaseCount('ocorrencia_imagens', 0);
        $this->assertDatabaseCount('ocorrencia_imagem_importacoes', 0);
        Bus::assertNothingBatched();
    }

    public function test_nao_afeta_preventivas(): void
    {
        Storage::fake('public');
        Bus::fake();

        $preventiva = Preventiva::factory()->create();
        PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'preventivas/1/foto.jpg',
            'position' => 1,
        ]);

        $ocorrencia = Ocorrencia::factory()->create();
        File::ensureDirectoryExists($this->pastaTemp.'/'.$ocorrencia->id);
        $this->gravarImagemFake($this->pastaTemp.'/'.$ocorrencia->id.'/a.jpg');

        $this->artisan('ocorrencias:importar-imagens', ['--pasta' => $this->pastaTemp])
            ->assertSuccessful();

        $this->assertDatabaseCount('preventiva_imagens', 1);
        $this->assertDatabaseHas('preventiva_imagens', [
            'preventiva_id' => $preventiva->id,
            'path' => 'preventivas/1/foto.jpg',
        ]);
    }

    public function test_ao_concluir_processamento_envia_email_com_ids(): void
    {
        Storage::fake('public');
        Mail::fake();

        $ocorrenciaA = Ocorrencia::factory()->create();
        $ocorrenciaB = Ocorrencia::factory()->create();

        File::ensureDirectoryExists($this->pastaTemp.'/'.$ocorrenciaA->id);
        File::ensureDirectoryExists($this->pastaTemp.'/'.$ocorrenciaB->id);
        $this->gravarImagemFake($this->pastaTemp.'/'.$ocorrenciaA->id.'/a.jpg');
        $this->gravarImagemFake($this->pastaTemp.'/'.$ocorrenciaB->id.'/b.jpg');

        $this->artisan('ocorrencias:importar-imagens', ['--pasta' => $this->pastaTemp])
            ->expectsOutputToContain('Importadas: 2')
            ->assertSuccessful();

        $this->assertDatabaseHas('ocorrencia_imagem_importacoes', [
            'ocorrencia_id' => $ocorrenciaA->id,
            'status' => OcorrenciaImagemImportacao::STATUS_CONCLUIDA,
        ]);
        $this->assertDatabaseHas('ocorrencia_imagem_importacoes', [
            'ocorrencia_id' => $ocorrenciaB->id,
            'status' => OcorrenciaImagemImportacao::STATUS_CONCLUIDA,
        ]);

        Mail::assertQueued(ImportacaoImagensOcorrenciasConcluida::class, function (ImportacaoImagensOcorrenciasConcluida $mail) use ($ocorrenciaA, $ocorrenciaB): bool {
            $ids = $mail->ocorrenciaIds;
            sort($ids);

            return $mail->hasTo('fabio@vbeton.com.br')
                && $mail->hasCc('fgpetter@gmail.com')
                && $mail->totalImagens === 2
                && $ids === [$ocorrenciaA->id, $ocorrenciaB->id];
        });
    }

    private function gravarImagemFake(string $path): void
    {
        $fake = UploadedFile::fake()->image(basename($path));
        File::ensureDirectoryExists(dirname($path));
        File::put($path, file_get_contents($fake->getRealPath()));
    }
}
