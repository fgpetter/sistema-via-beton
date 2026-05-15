<?php

namespace App\Jobs;

use App\Models\PreventivaImagem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class ProcessarImagemPreventiva implements ShouldQueue
{
    use Queueable;

    public function __construct(public PreventivaImagem $preventivaImagem) {}

    public function handle(): void
    {
        $disk = Storage::disk('public');

        if (! $disk->exists($this->preventivaImagem->path)) {
            return;
        }

        $manager = new ImageManager(new Driver);
        $image = $manager->decode($disk->path($this->preventivaImagem->path));
        $image->scaleDown(width: 1080, height: 1080);

        $dir = pathinfo($this->preventivaImagem->path, PATHINFO_DIRNAME);
        $name = pathinfo($this->preventivaImagem->path, PATHINFO_FILENAME);
        $newPath = "{$dir}/{$name}.jpg";

        $image->encode(new JpegEncoder(quality: 75))->save($disk->path($newPath));

        if ($newPath !== $this->preventivaImagem->path) {
            $disk->delete($this->preventivaImagem->path);
            $this->preventivaImagem->update(['path' => $newPath]);
        }
    }
}
