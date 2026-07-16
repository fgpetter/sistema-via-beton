<?php

namespace App\Jobs;

use App\Models\OcorrenciaImagem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;
use Throwable;

class ProcessarImagemOcorrencia implements ShouldQueue
{
    use Queueable;

    public bool $deleteWhenMissingModels = true;

    public function __construct(
        public OcorrenciaImagem $ocorrenciaImagem,
        public ?string $traceId = null
    ) {}

    public function handle(): void
    {
        Log::info('ocorrencia_imagem.job.iniciado', [
            'trace_id' => $this->traceId,
            'imagem_id' => $this->ocorrenciaImagem->id,
            'ocorrencia_id' => $this->ocorrenciaImagem->ocorrencia_id,
            'path' => $this->ocorrenciaImagem->path,
        ]);

        $disk = Storage::disk('public');

        if (! $disk->exists($this->ocorrenciaImagem->path)) {
            Log::warning('ocorrencia_imagem.job.arquivo_nao_encontrado', [
                'trace_id' => $this->traceId,
                'imagem_id' => $this->ocorrenciaImagem->id,
                'path' => $this->ocorrenciaImagem->path,
            ]);

            return;
        }

        $manager = new ImageManager(new Driver);
        $image = $manager->decode($disk->path($this->ocorrenciaImagem->path));
        $image->scaleDown(width: 1080, height: 1080);

        $dir = pathinfo($this->ocorrenciaImagem->path, PATHINFO_DIRNAME);
        $name = pathinfo($this->ocorrenciaImagem->path, PATHINFO_FILENAME);
        $newPath = "{$dir}/{$name}.jpg";

        $image->encode(new JpegEncoder(quality: 75))->save($disk->path($newPath));
        Log::info('ocorrencia_imagem.job.arquivo_convertido', [
            'trace_id' => $this->traceId,
            'imagem_id' => $this->ocorrenciaImagem->id,
            'path_origem' => $this->ocorrenciaImagem->path,
            'path_destino' => $newPath,
        ]);

        if ($newPath !== $this->ocorrenciaImagem->path) {
            $disk->delete($this->ocorrenciaImagem->path);
            $this->ocorrenciaImagem->update(['path' => $newPath]);
        }

        Log::info('ocorrencia_imagem.job.finalizado', [
            'trace_id' => $this->traceId,
            'imagem_id' => $this->ocorrenciaImagem->id,
            'path_final' => $this->ocorrenciaImagem->fresh()->path,
        ]);
    }

    public function failed(Throwable $exception): void
    {
        Log::error('ocorrencia_imagem.job.falhou', [
            'trace_id' => $this->traceId,
            'imagem_id' => $this->ocorrenciaImagem->id ?? null,
            'erro' => $exception->getMessage(),
        ]);
    }
}
