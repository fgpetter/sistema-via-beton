<?php

namespace App\Actions\Ocorrencias;

use App\Models\Ocorrencia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class RenderRatPdfFromOcorrencia
{
    public function __construct(
        private BuildRatPdfDataFromOcorrencia $buildRatPdfDataFromOcorrencia,
    ) {}

    public function __invoke(Ocorrencia $ocorrencia, ?Carbon $geradoEm = null): string
    {
        $dados = ($this->buildRatPdfDataFromOcorrencia)($ocorrencia, $geradoEm);

        return Pdf::loadView('pdf.rat', ['dados' => $dados])
            ->setPaper('a4', 'portrait')
            ->output();
    }
}
