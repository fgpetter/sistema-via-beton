<?php

namespace App\Jobs;

use App\Models\OcorrenciaImagem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class ProcessarImagemOcorrencia implements ShouldQueue
{
    use Queueable;

    public bool $deleteWhenMissingModels = true;

    public function __construct(public OcorrenciaImagem $ocorrenciaImagem) {}

    public function handle(): void
    {
        $disk = Storage::disk('public');

        if (! $disk->exists($this->ocorrenciaImagem->path)) {
            return;
        }

        $manager = new ImageManager(new Driver);
        $image = $manager->decode($disk->path($this->ocorrenciaImagem->path));
        $image->scaleDown(width: 1080, height: 1080);

        $dir = pathinfo($this->ocorrenciaImagem->path, PATHINFO_DIRNAME);
        $name = pathinfo($this->ocorrenciaImagem->path, PATHINFO_FILENAME);
        $newPath = "{$dir}/{$name}.jpg";

        $image->encode(new JpegEncoder(quality: 75))->save($disk->path($newPath));

        if ($newPath !== $this->ocorrenciaImagem->path) {
            $disk->delete($this->ocorrenciaImagem->path);
            $this->ocorrenciaImagem->update(['path' => $newPath]);
        }
    }
}
