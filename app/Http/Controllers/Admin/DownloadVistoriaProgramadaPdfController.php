<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Programadas\RenderVistoriaPdfFromProgramada;
use App\Http\Controllers\Controller;
use App\Models\Programada;
use Illuminate\Http\Response;

class DownloadVistoriaProgramadaPdfController extends Controller
{
    public function __construct(
        private RenderVistoriaPdfFromProgramada $renderVistoriaPdfFromProgramada,
    ) {}

    public function __invoke(Programada $programada): Response
    {
        abort_unless($programada->relatoriosDisponiveis(), 404);

        $pdf = ($this->renderVistoriaPdfFromProgramada)($programada);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="RelatorioTecnicoFotografico-'.$programada->id.'.pdf"',
        ]);
    }
}
