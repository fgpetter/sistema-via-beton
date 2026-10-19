<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Programadas\RenderRelatorioExecutivoPdfFromProgramada;
use App\Http\Controllers\Controller;
use App\Models\Programada;
use Illuminate\Http\Response;

class DownloadRelatorioExecutivoProgramadaPdfController extends Controller
{
    public function __construct(
        private RenderRelatorioExecutivoPdfFromProgramada $renderRelatorioExecutivoPdfFromProgramada,
    ) {}

    public function __invoke(Programada $programada): Response
    {
        abort_unless($programada->relatoriosDisponiveis(), 404);

        $pdf = ($this->renderRelatorioExecutivoPdfFromProgramada)($programada);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="RelatorioExecutivo-'.$programada->id.'.pdf"',
        ]);
    }
}
