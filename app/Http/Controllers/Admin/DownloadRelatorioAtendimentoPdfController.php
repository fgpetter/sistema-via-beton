<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Ocorrencias\RenderRelatorioAtendimentoPdfFromOcorrencia;
use App\Http\Controllers\Controller;
use App\Models\Ocorrencia;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadRelatorioAtendimentoPdfController extends Controller
{
    public function __construct(
        private RenderRelatorioAtendimentoPdfFromOcorrencia $renderRelatorioAtendimentoPdfFromOcorrencia,
    ) {}

    public function __invoke(Ocorrencia $ocorrencia): BinaryFileResponse
    {
        $disk = Storage::disk('public');
        $path = 'ocorrencias/'.$ocorrencia->id.'/relatorio/RelatorioAtendimento-'.$ocorrencia->id.'.pdf';

        if ($ocorrencia->relatorio_pdf_path === null || ! $disk->exists($path)) {
            $pdf = ($this->renderRelatorioAtendimentoPdfFromOcorrencia)($ocorrencia);
            $disk->put($path, $pdf);
            $ocorrencia->update(['relatorio_pdf_path' => $path]);
        }

        return response()->file(
            $disk->path($path),
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="RelatorioAtendimento-'.$ocorrencia->id.'.pdf"',
            ]
        );
    }
}
