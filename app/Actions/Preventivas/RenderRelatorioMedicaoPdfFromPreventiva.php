<?php

namespace App\Actions\Preventivas;

use App\Models\Preventiva;
use Barryvdh\DomPDF\Facade\Pdf;

class RenderRelatorioMedicaoPdfFromPreventiva
{
    public function __construct(
        private BuildRelatorioMedicaoPdfDataFromPreventiva $buildRelatorioMedicaoPdfDataFromPreventiva,
    ) {}

    public function __invoke(Preventiva $preventiva): string
    {
        $dados = ($this->buildRelatorioMedicaoPdfDataFromPreventiva)($preventiva);

        return Pdf::loadView('pdf.preventiva-relatorio-medicao', ['dados' => $dados])
            ->setPaper('a4', 'portrait')
            ->output();
    }
}
