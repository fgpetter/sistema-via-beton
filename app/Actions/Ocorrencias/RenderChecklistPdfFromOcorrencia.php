<?php

namespace App\Actions\Ocorrencias;

use App\Enums\TipoChecklist;
use App\Models\Ocorrencia;
use Barryvdh\DomPDF\Facade\Pdf;

class RenderChecklistPdfFromOcorrencia
{
    public function __construct(
        private BuildChecklistPdfDataFromOcorrencia $buildChecklistPdfDataFromOcorrencia,
    ) {}

    public function __invoke(Ocorrencia $ocorrencia, TipoChecklist $tipo): string
    {
        $dados = ($this->buildChecklistPdfDataFromOcorrencia)($ocorrencia, $tipo);

        return Pdf::loadView('pdf.checklist-ocorrencia', ['dados' => $dados])
            ->setPaper('a4', 'portrait')
            ->output();
    }
}
