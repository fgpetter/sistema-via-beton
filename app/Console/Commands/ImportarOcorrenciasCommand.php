<?php

namespace App\Console\Commands;

use App\Imports\OcorrenciasImport;
use App\Mail\ImportacaoOcorrenciasConcluida;
use App\Mail\ImportacaoOcorrenciasFalhou;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Finder\SplFileInfo;
use Throwable;

class ImportarOcorrenciasCommand extends Command
{
    protected $signature = 'ocorrencias:importar
                            {--pasta= : Pasta com os arquivos XLSX}';

    protected $description = 'Importa ocorrências a partir do XLSX mais recente na pasta';

    public function handle(): int
    {
        $pasta = $this->option('pasta') ?: base_path('temp');
        $arquivos = $this->arquivosXlsx($pasta);

        if ($arquivos->isEmpty()) {
            $this->info('Nenhum arquivo XLSX encontrado.');

            return self::SUCCESS;
        }

        /** @var SplFileInfo $arquivo */
        $arquivo = $arquivos
            ->sortByDesc(fn (SplFileInfo $file): int => $file->getMTime())
            ->first();

        try {
            $import = new OcorrenciasImport;
            Excel::import($import, $arquivo->getPathname());
        } catch (Throwable $e) {
            $this->registrarFalha($arquivo->getFilename(), $e);

            Mail::to('fgpetter@gmail.com')
                ->send(new ImportacaoOcorrenciasFalhou($arquivo->getFilename(), $e->getMessage()));

            $this->apagarXlsx($pasta);
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->apagarXlsx($pasta);

        $importadas = $import->getImportedCount();
        $linhasIgnoradas = $import->getSkippedCount();

        $this->info("Arquivo: {$arquivo->getFilename()}");
        $this->info("Importadas: {$importadas}");
        $this->info("Linhas ignoradas: {$linhasIgnoradas}");

        if ($importadas > 0) {
            Mail::to('fabio@vbeton.com.br')
                ->cc('fgpetter@gmail.com')
                ->send(new ImportacaoOcorrenciasConcluida(
                    $arquivo->getFilename(),
                    $importadas,
                    $linhasIgnoradas,
                ));
        }

        return self::SUCCESS;
    }

    /**
     * @return Collection<int, SplFileInfo>
     */
    private function arquivosXlsx(string $pasta): Collection
    {
        if (! File::isDirectory($pasta)) {
            return collect();
        }

        return collect(File::files($pasta))
            ->filter(fn (SplFileInfo $file): bool => strtolower($file->getExtension()) === 'xlsx')
            ->values();
    }

    private function apagarXlsx(string $pasta): void
    {
        foreach ($this->arquivosXlsx($pasta) as $file) {
            File::delete($file->getPathname());
        }
    }

    private function registrarFalha(string $arquivo, Throwable $e): void
    {
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/importcommand.log'),
        ])->error('Falha na importação de ocorrências', [
            'arquivo' => $arquivo,
            'exception' => $e::class,
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
    }
}
