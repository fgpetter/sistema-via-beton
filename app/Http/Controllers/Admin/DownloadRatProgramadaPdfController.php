<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Programada;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadRatProgramadaPdfController extends Controller
{
    public function __invoke(Programada $programada): BinaryFileResponse
    {
        abort_if($programada->rat_pdf_path === null, 404);
        $disk = Storage::disk('public');
        abort_unless($disk->exists($programada->rat_pdf_path), 404);

        return response()->file($disk->path($programada->rat_pdf_path), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="RAT-'.$programada->id.'.pdf"',
        ]);
    }
}
