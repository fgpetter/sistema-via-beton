<?php

namespace App\Jobs;

use App\Models\PreventivaMedicaoImagem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class ProcessarImagemMedicaoPreventiva implements ShouldQueue
{
    use Queueable;

    public function __construct(public PreventivaMedicaoImagem $preventivaMedicaoImagem) {}

    public function handle(): void
    {
        $disk = Storage::disk('public');

        if (! $disk->exists($this->preventivaMedicaoImagem->path)) {
            return;
        }

        $manager = new ImageManager(new Driver);
        $image = $manager->decode($disk->path($this->preventivaMedicaoImagem->path));
        $image->scaleDown(width: 1080, height: 1080);

        $dir = pathinfo($this->preventivaMedicaoImagem->path, PATHINFO_DIRNAME);
        $name = pathinfo($this->preventivaMedicaoImagem->path, PATHINFO_FILENAME);
        $newPath = "{$dir}/{$name}.jpg";

        $image->encode(new JpegEncoder(quality: 75))->save($disk->path($newPath));

        if ($newPath !== $this->preventivaMedicaoImagem->path) {
            $disk->delete($this->preventivaMedicaoImagem->path);
            $this->preventivaMedicaoImagem->update(['path' => $newPath]);
        }
    }
}
