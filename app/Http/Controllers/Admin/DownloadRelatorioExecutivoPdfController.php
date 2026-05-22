<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Preventivas\RenderRelatorioExecutivoPdfFromPreventiva;
use App\Http\Controllers\Controller;
use App\Models\Preventiva;
use Illuminate\Http\Response;

class DownloadRelatorioExecutivoPdfController extends Controller
{
    public function __construct(
        private RenderRelatorioExecutivoPdfFromPreventiva $renderRelatorioExecutivoPdfFromPreventiva,
    ) {}

    public function __invoke(Preventiva $preventiva): Response
    {
        abort_unless($preventiva->relatoriosDisponiveis(), 404);

        $pdf = ($this->renderRelatorioExecutivoPdfFromPreventiva)($preventiva);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="RelatorioExecutivo-'.$preventiva->id.'.pdf"',
        ]);
    }
}
