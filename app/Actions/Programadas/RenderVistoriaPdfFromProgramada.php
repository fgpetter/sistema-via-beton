<?php

namespace App\Actions\Programadas;

use App\Models\Programada;
use Barryvdh\DomPDF\Facade\Pdf;

class RenderVistoriaPdfFromProgramada
{
    public function __construct(
        private BuildVistoriaPdfDataFromProgramada $buildVistoriaPdfDataFromProgramada,
    ) {}

    public function __invoke(Programada $programada): string
    {
        $dados = ($this->buildVistoriaPdfDataFromProgramada)($programada);

        return Pdf::loadView('pdf.programada-relatorio', ['dados' => $dados])
            ->setPaper('a4', 'portrait')
            ->output();
    }
}
