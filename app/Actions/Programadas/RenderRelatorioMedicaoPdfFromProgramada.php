<?php

namespace App\Actions\Programadas;

use App\Models\Programada;
use Barryvdh\DomPDF\Facade\Pdf;

class RenderRelatorioMedicaoPdfFromProgramada
{
    public function __construct(
        private BuildRelatorioMedicaoPdfDataFromProgramada $buildRelatorioMedicaoPdfDataFromProgramada,
    ) {}

    public function __invoke(Programada $programada): string
    {
        $dados = ($this->buildRelatorioMedicaoPdfDataFromProgramada)($programada);

        return Pdf::loadView('pdf.programada-relatorio-medicao', ['dados' => $dados])
            ->setPaper('a4', 'portrait')
            ->output();
    }
}
