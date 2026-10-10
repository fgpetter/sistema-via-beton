<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Ocorrencias\RenderChecklistPdfFromOcorrencia;
use App\Enums\TipoChecklist;
use App\Http\Controllers\Controller;
use App\Models\Ocorrencia;
use Illuminate\Http\Response;

class DownloadChecklistPdfController extends Controller
{
    public function __construct(
        private RenderChecklistPdfFromOcorrencia $renderChecklistPdfFromOcorrencia,
    ) {}

    public function __invoke(Ocorrencia $ocorrencia, TipoChecklist $tipo): Response
    {
        $ocorrencia->loadMissing([$tipo->relacao(), 'colaborador', 'enderecoVinculado']);

        if ($ocorrencia->{$tipo->relacao()} === null) {
            abort(404);
        }

        $pdf = ($this->renderChecklistPdfFromOcorrencia)($ocorrencia, $tipo);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Checklist-'.$tipo->name.'-'.$ocorrencia->id.'.pdf"',
        ]);
    }
}
