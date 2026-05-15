<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Preventivas\RenderRelatorioExecutivoPdfFromPreventiva;
use App\Http\Controllers\Controller;
use App\Models\Preventiva;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadRelatorioExecutivoPdfController extends Controller
{
    public function __construct(
        private RenderRelatorioExecutivoPdfFromPreventiva $renderRelatorioExecutivoPdfFromPreventiva,
    ) {}

    public function __invoke(Preventiva $preventiva): BinaryFileResponse
    {
        $disk = Storage::disk('public');
        $path = 'preventivas/'.$preventiva->id.'/executivo/RelatorioExecutivo-'.$preventiva->id.'.pdf';

        if (! $disk->exists($path)) {
            $pdf = ($this->renderRelatorioExecutivoPdfFromPreventiva)($preventiva);
            $disk->put($path, $pdf);
        }

        return response()->file(
            $disk->path($path),
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="RelatorioExecutivo-'.$preventiva->id.'.pdf"',
            ]
        );
    }
}
