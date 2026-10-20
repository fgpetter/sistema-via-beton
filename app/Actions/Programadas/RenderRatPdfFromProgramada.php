<?php

namespace App\Actions\Programadas;

use App\Models\Programada;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class RenderRatPdfFromProgramada
{
    public function __construct(private BuildRatPdfDataFromProgramada $buildRatPdfDataFromProgramada) {}

    public function __invoke(Programada $programada, ?Carbon $geradoEm = null): string
    {
        return Pdf::loadView('pdf.rat', ['dados' => ($this->buildRatPdfDataFromProgramada)($programada, $geradoEm)])
            ->setPaper('a4', 'portrait')->output();
    }
}
