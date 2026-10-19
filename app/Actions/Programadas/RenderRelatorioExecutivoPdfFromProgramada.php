<?php

namespace App\Actions\Programadas;

use App\Models\Programada;
use Barryvdh\DomPDF\Facade\Pdf;

class RenderRelatorioExecutivoPdfFromProgramada
{
    public function __construct(
        private BuildRelatorioExecutivoPdfDataFromProgramada $buildRelatorioExecutivoPdfDataFromProgramada,
    ) {}

    public function __invoke(Programada $programada): string
    {
        $dados = ($this->buildRelatorioExecutivoPdfDataFromProgramada)($programada);

        return Pdf::loadView('pdf.programada-relatorio', ['dados' => $dados])
            ->setPaper('a4', 'portrait')
            ->output();
    }
}
