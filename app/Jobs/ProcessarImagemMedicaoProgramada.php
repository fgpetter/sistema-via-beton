<?php

namespace App\Jobs;

use App\Models\ProgramadaMedicaoImagem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class ProcessarImagemMedicaoProgramada implements ShouldQueue
{
    use Queueable;

    public function __construct(public ProgramadaMedicaoImagem $programadaMedicaoImagem) {}

    public function handle(): void
    {
        $disk = Storage::disk('public');

        if (! $disk->exists($this->programadaMedicaoImagem->path)) {
            return;
        }

        $manager = new ImageManager(new Driver);
        $image = $manager->decode($disk->path($this->programadaMedicaoImagem->path));
        $image->scaleDown(width: 1080, height: 1080);

        $dir = pathinfo($this->programadaMedicaoImagem->path, PATHINFO_DIRNAME);
        $name = pathinfo($this->programadaMedicaoImagem->path, PATHINFO_FILENAME);
        $newPath = "{$dir}/{$name}.jpg";

        $image->encode(new JpegEncoder(quality: 75))->save($disk->path($newPath));

        if ($newPath !== $this->programadaMedicaoImagem->path) {
            $disk->delete($this->programadaMedicaoImagem->path);
            $this->programadaMedicaoImagem->update(['path' => $newPath]);
        }
    }
}
