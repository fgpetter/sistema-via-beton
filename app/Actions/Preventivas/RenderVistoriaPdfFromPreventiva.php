<?php

namespace App\Actions\Preventivas;

use App\Models\Preventiva;
use Barryvdh\DomPDF\Facade\Pdf;

class RenderVistoriaPdfFromPreventiva
{
    public function __construct(
        private BuildVistoriaPdfDataFromPreventiva $buildVistoriaPdfDataFromPreventiva,
    ) {}

    public function __invoke(Preventiva $preventiva): string
    {
        $dados = ($this->buildVistoriaPdfDataFromPreventiva)($preventiva);

        return Pdf::loadView('pdf.preventiva-relatorio', ['dados' => $dados])
            ->setPaper('a4', 'portrait')
            ->output();
    }
}
