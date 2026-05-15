<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Preventivas\RenderVistoriaPdfFromPreventiva;
use App\Http\Controllers\Controller;
use App\Models\Preventiva;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadVistoriaPdfController extends Controller
{
    public function __construct(
        private RenderVistoriaPdfFromPreventiva $renderVistoriaPdfFromPreventiva,
    ) {}

    public function __invoke(Preventiva $preventiva): BinaryFileResponse
    {
        $disk = Storage::disk('public');
        $path = 'preventivas/'.$preventiva->id.'/vistoria/Vistoria-'.$preventiva->id.'.pdf';

        if (! $disk->exists($path)) {
            $pdf = ($this->renderVistoriaPdfFromPreventiva)($preventiva);
            $disk->put($path, $pdf);
        }

        return response()->file(
            $disk->path($path),
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="Vistoria-'.$preventiva->id.'.pdf"',
            ]
        );
    }
}
