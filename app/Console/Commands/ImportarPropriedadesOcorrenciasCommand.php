<?php

namespace App\Console\Commands;

use App\Models\Disciplina;
use App\Models\Ocorrencia;
use App\Models\ResponsavelEngenharia;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use stdClass;
use Throwable;

class ImportarPropriedadesOcorrenciasCommand extends Command
{
    protected $signature = 'ocorrencias:importar-propriedades
                            {arquivo? : Caminho do JSON (padrão: temp/ocorrencias.json)}
                            {--dry-run : Simula sem salvar dados ou marcar ocorrências}';

    protected $description = 'Importa uma única vez as propriedades SDM das ocorrências existentes';

    private const array CAMPOS = [
        'gestor_banrisul' => 'responsavel_engenharia_id',
        'disciplina' => 'disciplina_id',
        'subdisciplina' => 'subdisciplina_1_id',
        'subdisciplina_2' => 'subdisciplina_2_id',
        'subdisciplina_3' => 'subdisciplina_3_id',
        'subdisciplina_4' => 'subdisciplina_4_id',
        'subdisciplina_5' => 'subdisciplina_5_id',
        'subdisciplina_6' => 'subdisciplina_6_id',
    ];

    public function handle(): int
    {
        $arquivo = $this->argument('arquivo') ?? base_path('temp/ocorrencias.json');
        $simular = (bool) $this->option('dry-run');
        $logger = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/importar-propriedades-ocorrencias.log'),
            'locking' => true,
        ]);

        try {
            $ocorrencias = $this->lerOcorrencias($arquivo);
            $catalogos = $this->carregarCatalogos();
        } catch (Throwable $e) {
            $this->error($e->getMessage());
            $logger->error($e->getMessage(), ['arquivo' => $arquivo, 'simulacao' => $simular]);

            return self::FAILURE;
        }

        $totais = ['processadas' => 0, 'previstas' => 0, 'ja_processadas' => 0, 'nao_encontradas' => 0, 'erros' => 0];

        foreach ($ocorrencias as $id => $entrada) {
            if (! preg_match('/^[1-9][0-9]*$/', (string) $id)
                || ! $entrada instanceof stdClass
                || ! ($entrada->propriedades ?? null) instanceof stdClass) {
                $this->warn("Ocorrência {$id}: identificador ou estrutura de propriedades inválida.");
                $totais['erros']++;

                continue;
            }

            try {
                $resultado = DB::transaction(function () use ($id, $entrada, $catalogos, $simular): array {
                    $ocorrencia = Ocorrencia::query()->lockForUpdate()->find($id);

                    if ($ocorrencia === null) {
                        return ['status' => 'nao_encontradas', 'avisos' => [], 'alteracoes' => []];
                    }

                    // A marcação precisa ser lida sob o mesmo lock usado na atualização.
                    if ($ocorrencia->propriedades_sdm_importadas_em !== null) {
                        return ['status' => 'ja_processadas', 'avisos' => [], 'alteracoes' => []];
                    }

                    [$alteracoes, $avisos] = $this->resolverPropriedades($ocorrencia, $entrada->propriedades, $catalogos);

                    if (! $simular) {
                        foreach ($alteracoes as $coluna => $valor) {
                            $ocorrencia->{$coluna} = $valor;
                        }

                        // Mesmo sem alterações, a primeira entrada válida encerra o processamento.
                        $ocorrencia->propriedades_sdm_importadas_em = now();

                        if (! $ocorrencia->save()) {
                            throw new RuntimeException('Não foi possível salvar a ocorrência.');
                        }
                    }

                    return [
                        'status' => $simular ? 'previstas' : 'processadas',
                        'avisos' => $avisos,
                        'alteracoes' => $alteracoes,
                    ];
                });
            } catch (Throwable $e) {
                $this->error("Ocorrência {$id}: falha no processamento: {$e->getMessage()}");
                $totais['erros']++;

                continue;
            }

            // Contabilizar e anunciar somente após a confirmação da transação.
            $totais[$resultado['status']]++;

            foreach ($resultado['avisos'] as $aviso) {
                $this->warn("Ocorrência {$id}: {$aviso}");
            }

            if ($resultado['status'] === 'nao_encontradas') {
                $this->warn("Ocorrência {$id}: não encontrada.");
            } elseif ($resultado['status'] === 'ja_processadas') {
                $this->line("Ocorrência {$id}: já processada; ignorada.");
            } else {
                $campos = implode(', ', array_keys($resultado['alteracoes'])) ?: 'nenhum campo alterado';
                $acao = $simular ? 'processamento previsto' : 'processamento concluído';
                $this->info("Ocorrência {$id}: {$acao} ({$campos}).");
            }
        }

        $resumo = ["Processadas: {$totais['processadas']}"];

        if ($simular) {
            $resumo[] = "Previstas (simulação, sem gravação): {$totais['previstas']}";
        }

        $resumo[] = "Já processadas: {$totais['ja_processadas']}";
        $resumo[] = "Não encontradas: {$totais['nao_encontradas']}";
        $resumo[] = "Erros: {$totais['erros']}";

        foreach ($resumo as $mensagem) {
            $this->info($mensagem);
            $logger->info($mensagem);
        }

        return $totais['erros'] > 0 ? self::FAILURE : self::SUCCESS;
    }

    private function lerOcorrencias(string $arquivo): stdClass
    {
        if (! File::isFile($arquivo) || ! File::isReadable($arquivo)) {
            throw new RuntimeException("Arquivo inexistente ou sem permissão de leitura: {$arquivo}");
        }

        $dados = json_decode(File::get($arquivo), flags: JSON_THROW_ON_ERROR);

        if (! $dados instanceof stdClass || ! ($dados->ocorrencias ?? null) instanceof stdClass) {
            throw new RuntimeException('JSON inválido: a raiz deve conter o objeto ocorrencias.');
        }

        return $dados->ocorrencias;
    }

    /**
     * @return array<string, array<string, list<int>>>
     */
    private function carregarCatalogos(): array
    {
        $catalogos = ['gestores' => [], 'disciplinas' => [], 'subdisciplinas' => []];

        foreach (ResponsavelEngenharia::withTrashed()->get(['id', 'nome']) as $responsavel) {
            $catalogos['gestores'][$this->normalizarNome($responsavel->nome)][] = $responsavel->id;
        }

        foreach (Disciplina::query()->get(['id', 'disciplina', 'subdisciplina']) as $disciplina) {
            $tipo = $disciplina->subdisciplina ? 'subdisciplinas' : 'disciplinas';
            $catalogos[$tipo][$this->normalizarNome($disciplina->disciplina)][] = $disciplina->id;
        }

        return $catalogos;
    }

    /**
     * @param  array<string, array<string, list<int>>>  $catalogos
     * @return array{0: array<string, int>, 1: list<string>}
     */
    private function resolverPropriedades(Ocorrencia $ocorrencia, stdClass $propriedades, array $catalogos): array
    {
        $alteracoes = [];
        $avisos = [];

        foreach (self::CAMPOS as $origem => $destino) {
            $valor = $propriedades->{$origem} ?? null;

            if ($valor === null || (is_string($valor) && trim($valor) === '')) {
                continue;
            }

            if (! is_string($valor)) {
                $avisos[] = "{$origem}: tipo inválido; valor atual preservado.";

                continue;
            }

            $tipo = match ($origem) {
                'gestor_banrisul' => 'gestores',
                'disciplina' => 'disciplinas',
                default => 'subdisciplinas',
            };
            $ids = $catalogos[$tipo][$this->normalizarNome($valor)] ?? [];

            if (count($ids) !== 1) {
                $motivo = $ids === [] ? 'sem correspondência no catálogo do tipo esperado' : 'correspondência ambígua';
                $avisos[] = "{$origem}: {$motivo}; valor atual preservado.";

                continue;
            }

            if ((string) $ocorrencia->{$destino} !== (string) $ids[0]) {
                $alteracoes[$destino] = $ids[0];
            }
        }

        return [$alteracoes, $avisos];
    }

    private function normalizarNome(string $nome): string
    {
        return mb_strtolower(trim($nome), 'UTF-8');
    }
}
