<?php

namespace App\Jobs;

use App\Models\ProgramadaImagem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class ProcessarImagemProgramada implements ShouldQueue
{
    use Queueable;

    public function __construct(public ProgramadaImagem $programadaImagem) {}

    public function handle(): void
    {
        $disk = Storage::disk('public');

        if (! $disk->exists($this->programadaImagem->path)) {
            return;
        }

        $manager = new ImageManager(new Driver);
        $image = $manager->decode($disk->path($this->programadaImagem->path));
        $image->scaleDown(width: 1080, height: 1080);

        $dir = pathinfo($this->programadaImagem->path, PATHINFO_DIRNAME);
        $name = pathinfo($this->programadaImagem->path, PATHINFO_FILENAME);
        $newPath = "{$dir}/{$name}.jpg";

        $image->encode(new JpegEncoder(quality: 75))->save($disk->path($newPath));

        if ($newPath !== $this->programadaImagem->path) {
            $disk->delete($this->programadaImagem->path);
            $this->programadaImagem->update(['path' => $newPath]);
        }
    }
}
