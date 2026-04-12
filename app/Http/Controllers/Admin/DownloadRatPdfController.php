<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ocorrencia;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadRatPdfController extends Controller
{
    public function __invoke(Ocorrencia $ocorrencia): BinaryFileResponse
    {
        if ($ocorrencia->rat_pdf_path === null) {
            abort(404);
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($ocorrencia->rat_pdf_path)) {
            abort(404);
        }

        return response()->file(
            $disk->path($ocorrencia->rat_pdf_path),
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="RAT-'.$ocorrencia->id.'.pdf"',
            ]
        );
    }
}
