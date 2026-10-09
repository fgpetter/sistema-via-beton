<?php

namespace App\Console\Commands;

use App\Enums\TipoImagemOcorrencia;
use App\Jobs\ProcessarImagemOcorrencia;
use App\Mail\ImportacaoImagensOcorrenciasConcluida;
use App\Models\Ocorrencia;
use App\Models\OcorrenciaImagem;
use App\Models\OcorrenciaImagemImportacao;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ImportarImagensOcorrenciasCommand extends Command
{
    protected $signature = 'ocorrencias:importar-imagens {--pasta= : Pasta com subpastas por ID de ocorrência}';

    protected $description = 'Importa imagens temporárias de ocorrências e enfileira o processamento';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $pasta = $this->option('pasta') ?: base_path('temp/images');

        if (! FileFacade::isDirectory($pasta)) {
            $this->info('Pasta de imagens não encontrada.');

            return self::SUCCESS;
        }

        $diretorios = collect(FileFacade::directories($pasta))
            ->filter(fn (string $dir): bool => ctype_digit(basename($dir)))
            ->sort()
            ->values();

        $importadas = 0;
        $ignoradas = 0;
        $erros = 0;
        /** @var list<ProcessarImagemOcorrencia> $jobs */
        $jobs = [];
        /** @var list<int> $importacaoIds */
        $importacaoIds = [];
        /** @var list<int> $ocorrenciaIds */
        $ocorrenciaIds = [];

        foreach ($diretorios as $diretorio) {
            $ocorrenciaId = (int) basename($diretorio);
            $resultado = $this->prepararPasta($diretorio, $ocorrenciaId);

            if ($resultado['status'] === 'ignorada') {
                $ignoradas++;

                continue;
            }

            if ($resultado['status'] === 'erro') {
                $erros++;

                continue;
            }

            $importadas++;
            $jobs = array_merge($jobs, $resultado['jobs']);
            $importacaoIds[] = $resultado['importacao_id'];
            $ocorrenciaIds[] = $resultado['ocorrencia_id'];
        }

        if ($jobs !== []) {
            $totalImagens = count($jobs);

            $batch = Bus::batch($jobs)
                ->name('ocorrencia-imagens-importacao')
                ->then(function (Batch $batch) use ($importacaoIds, $ocorrenciaIds, $totalImagens): void {
                    OcorrenciaImagemImportacao::query()
                        ->whereKey($importacaoIds)
                        ->update([
                            'status' => OcorrenciaImagemImportacao::STATUS_CONCLUIDA,
                            'concluida_em' => now(),
                        ]);

                    Mail::to('fabio@vbeton.com.br')
                        ->cc('fgpetter@gmail.com')
                        ->send(new ImportacaoImagensOcorrenciasConcluida(
                            $ocorrenciaIds,
                            $totalImagens,
                        ));
                })
                ->catch(function (Batch $batch, Throwable $e) use ($importacaoIds): void {
                    OcorrenciaImagemImportacao::query()
                        ->whereKey($importacaoIds)
                        ->update([
                            'status' => OcorrenciaImagemImportacao::STATUS_FALHOU,
                            'falhou_em' => now(),
                        ]);
                })
                ->dispatch();

            OcorrenciaImagemImportacao::query()
                ->whereKey($importacaoIds)
                ->update(['batch_id' => $batch->id]);
        }

        $this->info("Pastas lidas: {$diretorios->count()}");
        $this->info("Importadas: {$importadas}");
        $this->info("Ignoradas: {$ignoradas}");
        $this->info("Erros: {$erros}");

        return self::SUCCESS;
    }

    /**
     * @return array{status: 'pronta', jobs: list<ProcessarImagemOcorrencia>, importacao_id: int, ocorrencia_id: int}|array{status: 'ignorada'|'erro'}
     */
    private function prepararPasta(string $diretorio, int $ocorrenciaId): array
    {
        $importacao = OcorrenciaImagemImportacao::query()
            ->where('ocorrencia_id', $ocorrenciaId)
            ->first();

        if ($importacao !== null && in_array($importacao->status, [
            OcorrenciaImagemImportacao::STATUS_CONCLUIDA,
            OcorrenciaImagemImportacao::STATUS_PROCESSANDO,
        ], true)) {
            return ['status' => 'ignorada'];
        }

        $ocorrencia = Ocorrencia::query()->find($ocorrenciaId);

        if ($ocorrencia === null) {
            $this->error("Ocorrência {$ocorrenciaId} não encontrada.");

            return ['status' => 'erro'];
        }

        if ($this->possuiImagensExternas($ocorrencia, $importacao)) {
            return ['status' => 'ignorada'];
        }

        if ($importacao === null) {
            $arquivos = $this->arquivosPermitidos($diretorio);

            if ($arquivos->isEmpty()) {
                $this->error("Pasta {$ocorrenciaId} sem imagens permitidas.");

                return ['status' => 'erro'];
            }

            $importacao = OcorrenciaImagemImportacao::query()->create([
                'ocorrencia_id' => $ocorrencia->id,
                'status' => OcorrenciaImagemImportacao::STATUS_PROCESSANDO,
                'iniciada_em' => now(),
            ]);

            $par = $ocorrencia->proximoPar();

            foreach ($arquivos as $arquivo) {
                $path = Storage::disk('public')->putFile(
                    "ocorrencias/{$ocorrencia->id}/antes",
                    new File($arquivo)
                );

                OcorrenciaImagem::query()->create([
                    'ocorrencia_id' => $ocorrencia->id,
                    'tipo' => TipoImagemOcorrencia::Antes,
                    'par' => $par,
                    'path' => $path,
                    'ocorrencia_imagem_importacao_id' => $importacao->id,
                ]);

                $par++;
            }
        } else {
            $importacao->update([
                'status' => OcorrenciaImagemImportacao::STATUS_PROCESSANDO,
                'iniciada_em' => now(),
                'falhou_em' => null,
            ]);
        }

        $imagens = $importacao->imagens()->get();

        if ($imagens->isEmpty()) {
            $this->error("Importação {$ocorrenciaId} sem imagens vinculadas.");
            $importacao->update([
                'status' => OcorrenciaImagemImportacao::STATUS_FALHOU,
                'falhou_em' => now(),
            ]);

            return ['status' => 'erro'];
        }

        return [
            'status' => 'pronta',
            'jobs' => $imagens
                ->map(fn (OcorrenciaImagem $imagem): ProcessarImagemOcorrencia => new ProcessarImagemOcorrencia($imagem))
                ->all(),
            'importacao_id' => $importacao->id,
            'ocorrencia_id' => $ocorrencia->id,
        ];
    }

    /**
     * A Ocorrência não deve ser importada quando já possui imagens que não pertencem
     * à importação em andamento (retomada de falha), evitando duplicata ou substituição.
     */
    private function possuiImagensExternas(Ocorrencia $ocorrencia, ?OcorrenciaImagemImportacao $importacao): bool
    {
        return OcorrenciaImagem::query()
            ->where('ocorrencia_id', $ocorrencia->id)
            ->when(
                $importacao !== null,
                fn (Builder $query): Builder => $query->where(function (Builder $query) use ($importacao): void {
                    $query->whereNull('ocorrencia_imagem_importacao_id')
                        ->orWhere('ocorrencia_imagem_importacao_id', '!=', $importacao->id);
                })
            )
            ->exists();
    }

    /**
     * @return Collection<int, string>
     */
    private function arquivosPermitidos(string $diretorio): Collection
    {
        return collect(FileFacade::files($diretorio))
            ->filter(function ($file): bool {
                $extensao = strtolower($file->getExtension());

                return in_array($extensao, ['jpg', 'jpeg', 'png'], true);
            })
            ->sortBy(fn ($file): string => $file->getFilename())
            ->map(fn ($file): string => $file->getPathname())
            ->values();
    }
}
