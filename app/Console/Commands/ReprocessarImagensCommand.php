<?php

namespace App\Console\Commands;

use App\Jobs\ProcessarImagemOcorrencia;
use App\Jobs\ProcessarImagemPreventiva;
use App\Models\OcorrenciaImagem;
use App\Models\PreventivaImagem;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ReprocessarImagensCommand extends Command
{
    protected $signature = 'imagens:reprocessar
                            {pasta : ocorrencias|preventivas}
                            {--step= : Limite de imagens a enfileirar (ex.: 1 para teste)}';

    protected $description = 'Reprocessa imagens enfileirando jobs a partir de ocorrencias ou preventivas';

    public function handle(): int
    {
        $pasta = (string) $this->argument('pasta');

        if (! in_array($pasta, ['ocorrencias', 'preventivas'], true)) {
            $this->error('Pasta inválida. Use: ocorrencias ou preventivas.');

            return self::FAILURE;
        }

        $step = $this->option('step');

        if ($step !== null && (! ctype_digit((string) $step) || (int) $step < 1)) {
            $this->error('O valor de --step deve ser um inteiro maior ou igual a 1.');

            return self::FAILURE;
        }

        $limite = $step !== null ? (int) $step : null;

        /** @var array{model: class-string<Model>, job: class-string} $contexto */
        $contexto = $this->contextoParaPasta($pasta);

        $files = Storage::disk('public')->allFiles($pasta);
        $total = count($files);
        $enfileirados = 0;
        $orfaos = 0;
        $jaDespachou = false;

        foreach ($files as $path) {
            if ($limite !== null && $enfileirados >= $limite) {
                break;
            }

            $imagem = $contexto['model']::query()->where('path', $path)->first();

            if ($imagem === null) {
                $this->registrarOrfao($path);
                $orfaos++;

                continue;
            }

            if ($jaDespachou) {
                $this->aguardarEntreDispatches();
            }

            ($contexto['job'])::dispatch($imagem);
            $jaDespachou = true;
            $enfileirados++;
        }

        $this->info("Arquivos lidos: {$total}");
        $this->info("Enfileirados: {$enfileirados}");
        $this->info("Órfãos: {$orfaos}");

        return self::SUCCESS;
    }

    /**
     * @return array{model: class-string<Model>, job: class-string}
     */
    private function contextoParaPasta(string $pasta): array
    {
        return match ($pasta) {
            'ocorrencias' => [
                'model' => OcorrenciaImagem::class,
                'job' => ProcessarImagemOcorrencia::class,
            ],
            'preventivas' => [
                'model' => PreventivaImagem::class,
                'job' => ProcessarImagemPreventiva::class,
            ],
        };
    }

    private function registrarOrfao(string $path): void
    {
        file_put_contents(
            storage_path('logs/images_to_prune.log'),
            $path.PHP_EOL,
            FILE_APPEND
        );
    }

    protected function aguardarEntreDispatches(): void
    {
        sleep(1);
    }
}
