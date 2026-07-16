<?php

namespace Tests\Feature\Console;

use App\Enums\TipoImagemOcorrencia;
use App\Jobs\ProcessarImagemOcorrencia;
use App\Jobs\ProcessarImagemPreventiva;
use App\Models\Ocorrencia;
use App\Models\OcorrenciaImagem;
use App\Models\Preventiva;
use App\Models\PreventivaImagem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ReprocessarImagensCommandTest extends TestCase
{
    use RefreshDatabase;

    private string $logPath;

    private string $procLogPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->logPath = storage_path('logs/images_to_prune.log');
        $this->procLogPath = storage_path('logs/images_proc.log');

        foreach ([$this->logPath, $this->procLogPath] as $path) {
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    protected function tearDown(): void
    {
        foreach ([$this->logPath, $this->procLogPath] as $path) {
            if (file_exists($path)) {
                unlink($path);
            }
        }

        parent::tearDown();
    }

    public function test_enfileira_job_de_ocorrencia_para_arquivo_com_registro(): void
    {
        Storage::fake('public');
        Queue::fake();

        $ocorrencia = Ocorrencia::factory()->create();
        $path = "ocorrencias/{$ocorrencia->id}/antes/foto.jpg";
        Storage::disk('public')->put($path, 'fake-image');

        OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => $path,
        ]);

        $this->artisan('imagens:reprocessar', ['pasta' => 'ocorrencias'])
            ->expectsOutputToContain('Arquivos lidos: 1')
            ->expectsOutputToContain('Enfileirados: 1')
            ->expectsOutputToContain('Órfãos: 0')
            ->assertSuccessful();

        Queue::assertPushed(ProcessarImagemOcorrencia::class);
        Queue::assertNotPushed(ProcessarImagemPreventiva::class);
        $this->assertFileExists($this->procLogPath);
        $this->assertStringContainsString($path, (string) file_get_contents($this->procLogPath));
    }

    public function test_enfileira_job_de_preventiva_para_arquivo_com_registro(): void
    {
        Storage::fake('public');
        Queue::fake();

        $preventiva = Preventiva::factory()->create();
        $path = "preventivas/{$preventiva->id}/foto.jpg";
        Storage::disk('public')->put($path, 'fake-image');

        PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => $path,
            'position' => 1,
        ]);

        $this->artisan('imagens:reprocessar', ['pasta' => 'preventivas'])
            ->expectsOutputToContain('Arquivos lidos: 1')
            ->expectsOutputToContain('Enfileirados: 1')
            ->expectsOutputToContain('Órfãos: 0')
            ->assertSuccessful();

        Queue::assertPushed(ProcessarImagemPreventiva::class);
        Queue::assertNotPushed(ProcessarImagemOcorrencia::class);
    }

    public function test_arquivo_orfao_nao_enfileira_e_registra_no_log(): void
    {
        Storage::fake('public');
        Queue::fake();

        $path = 'ocorrencias/999/antes/orfao.jpg';
        Storage::disk('public')->put($path, 'fake-image');

        $this->artisan('imagens:reprocessar', ['pasta' => 'ocorrencias'])
            ->expectsOutputToContain('Arquivos lidos: 1')
            ->expectsOutputToContain('Enfileirados: 0')
            ->expectsOutputToContain('Órfãos: 1')
            ->assertSuccessful();

        Queue::assertNothingPushed();
        $this->assertFileExists($this->logPath);
        $this->assertStringContainsString($path, (string) file_get_contents($this->logPath));
    }

    public function test_pasta_invalida_falha(): void
    {
        $this->artisan('imagens:reprocessar', ['pasta' => 'invalidas'])
            ->expectsOutputToContain('Pasta inválida')
            ->assertFailed();
    }

    public function test_atrasa_execucao_dos_jobs_em_um_segundo_entre_si(): void
    {
        Storage::fake('public');
        Queue::fake();

        $ocorrencia = Ocorrencia::factory()->create();

        foreach ([1, 2] as $par) {
            $path = "ocorrencias/{$ocorrencia->id}/antes/foto-{$par}.jpg";
            Storage::disk('public')->put($path, 'fake-image');

            OcorrenciaImagem::create([
                'ocorrencia_id' => $ocorrencia->id,
                'tipo' => TipoImagemOcorrencia::Antes,
                'par' => $par,
                'path' => $path,
            ]);
        }

        $this->artisan('imagens:reprocessar', ['pasta' => 'ocorrencias'])
            ->expectsOutputToContain('Enfileirados: 2')
            ->assertSuccessful();

        $delays = [];

        Queue::assertPushed(ProcessarImagemOcorrencia::class, function (ProcessarImagemOcorrencia $job) use (&$delays): bool {
            $delays[] = $job->delay;

            return true;
        });

        $this->assertSame([0, 1], $delays);
    }

    public function test_step_limita_quantidade_de_imagens_enfileiradas(): void
    {
        Storage::fake('public');
        Queue::fake();

        $ocorrencia = Ocorrencia::factory()->create();

        foreach ([1, 2, 3] as $par) {
            $path = "ocorrencias/{$ocorrencia->id}/antes/foto-{$par}.jpg";
            Storage::disk('public')->put($path, 'fake-image');

            OcorrenciaImagem::create([
                'ocorrencia_id' => $ocorrencia->id,
                'tipo' => TipoImagemOcorrencia::Antes,
                'par' => $par,
                'path' => $path,
            ]);
        }

        $this->artisan('imagens:reprocessar', [
            'pasta' => 'ocorrencias',
            '--step' => 1,
        ])
            ->expectsOutputToContain('Enfileirados: 1')
            ->assertSuccessful();

        Queue::assertPushed(ProcessarImagemOcorrencia::class, 1);
    }

    public function test_step_invalido_falha(): void
    {
        $this->artisan('imagens:reprocessar', [
            'pasta' => 'ocorrencias',
            '--step' => 0,
        ])
            ->expectsOutputToContain('--step deve ser um inteiro maior ou igual a 1')
            ->assertFailed();
    }

    public function test_desconsidera_arquivos_com_extensao_nao_permitida(): void
    {
        Storage::fake('public');
        Queue::fake();

        $ocorrencia = Ocorrencia::factory()->create();
        $pathJpg = "ocorrencias/{$ocorrencia->id}/antes/foto.jpg";
        $pathTxt = "ocorrencias/{$ocorrencia->id}/antes/readme.txt";
        $pathWebp = "ocorrencias/{$ocorrencia->id}/antes/foto.webp";

        Storage::disk('public')->put($pathJpg, 'fake-image');
        Storage::disk('public')->put($pathTxt, 'texto');
        Storage::disk('public')->put($pathWebp, 'fake-webp');

        OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => $pathJpg,
        ]);

        $this->artisan('imagens:reprocessar', ['pasta' => 'ocorrencias'])
            ->expectsOutputToContain('Arquivos lidos: 1')
            ->expectsOutputToContain('Enfileirados: 1')
            ->expectsOutputToContain('Órfãos: 0')
            ->assertSuccessful();

        Queue::assertPushed(ProcessarImagemOcorrencia::class, 1);
        $this->assertFileDoesNotExist($this->logPath);
    }
}
