<?php

namespace App\Actions\Ocorrencias;

use App\Models\Ocorrencia;
use Barryvdh\DomPDF\Facade\Pdf;

class RenderRelatorioAtendimentoPdfFromOcorrencia
{
    public function __construct(
        private BuildRelatorioAtendimentoPdfDataFromOcorrencia $buildRelatorioAtendimentoPdfDataFromOcorrencia,
    ) {}

    public function __invoke(Ocorrencia $ocorrencia): string
    {
        $dados = ($this->buildRelatorioAtendimentoPdfDataFromOcorrencia)($ocorrencia);

        return Pdf::loadView('pdf.relatorio-atendimento', ['dados' => $dados])
            ->setPaper('a4', 'portrait')
            ->output();
    }
}
