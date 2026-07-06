<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Preventivas\RenderRelatorioMedicaoPdfFromPreventiva;
use App\Http\Controllers\Controller;
use App\Models\Preventiva;
use Illuminate\Http\Response;

class DownloadRelatorioMedicaoPdfController extends Controller
{
    public function __construct(
        private RenderRelatorioMedicaoPdfFromPreventiva $renderRelatorioMedicaoPdfFromPreventiva,
    ) {}

    public function __invoke(Preventiva $preventiva): Response
    {
        abort_unless($preventiva->relatorioMedicaoDisponivel(), 404);

        $pdf = ($this->renderRelatorioMedicaoPdfFromPreventiva)($preventiva);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="RelatorioMedicao-'.$preventiva->id.'.pdf"',
        ]);
    }
}
