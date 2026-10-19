<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Programadas\RenderRelatorioMedicaoPdfFromProgramada;
use App\Http\Controllers\Controller;
use App\Models\Programada;
use Illuminate\Http\Response;

class DownloadRelatorioMedicaoProgramadaPdfController extends Controller
{
    public function __construct(
        private RenderRelatorioMedicaoPdfFromProgramada $renderRelatorioMedicaoPdfFromProgramada,
    ) {}

    public function __invoke(Programada $programada): Response
    {
        abort_unless($programada->relatorioMedicaoDisponivel(), 404);

        $pdf = ($this->renderRelatorioMedicaoPdfFromProgramada)($programada);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="RelatorioMedicao-'.$programada->id.'.pdf"',
        ]);
    }
}
