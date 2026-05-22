<?php

namespace App\Actions\Preventivas;

use App\Models\Preventiva;
use Barryvdh\DomPDF\Facade\Pdf;

class RenderRelatorioExecutivoPdfFromPreventiva
{
    public function __construct(
        private BuildRelatorioExecutivoPdfDataFromPreventiva $buildRelatorioExecutivoPdfDataFromPreventiva,
    ) {}

    public function __invoke(Preventiva $preventiva): string
    {
        $dados = ($this->buildRelatorioExecutivoPdfDataFromPreventiva)($preventiva);

        return Pdf::loadView('pdf.preventiva-relatorio', ['dados' => $dados])
            ->setPaper('a4', 'portrait')
            ->output();
    }
}
