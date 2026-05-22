<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Preventivas\RenderVistoriaPdfFromPreventiva;
use App\Http\Controllers\Controller;
use App\Models\Preventiva;
use Illuminate\Http\Response;

class DownloadVistoriaPdfController extends Controller
{
    public function __construct(
        private RenderVistoriaPdfFromPreventiva $renderVistoriaPdfFromPreventiva,
    ) {}

    public function __invoke(Preventiva $preventiva): Response
    {
        abort_unless($preventiva->relatoriosDisponiveis(), 404);

        $pdf = ($this->renderVistoriaPdfFromPreventiva)($preventiva);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="RelatorioTecnicoFotografico-'.$preventiva->id.'.pdf"',
        ]);
    }
}
