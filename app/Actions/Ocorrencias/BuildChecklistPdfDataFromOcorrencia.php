<?php

namespace App\Actions\Ocorrencias;

use App\Contracts\ChecklistBlocoContract;
use App\Contracts\ChecklistItemContract;
use App\Enums\TipoChecklist;
use App\Models\Ocorrencia;
use App\Models\OcorrenciaChecklistCivil;
use App\Models\OcorrenciaChecklistEletrica;

class BuildChecklistPdfDataFromOcorrencia
{
    /**
     * @return array{
     *   titulo: string,
     *   rotulo_nao_aplica: string,
     *   agencia: string,
     *   responsavel_tecnico: string,
     *   data: string,
     *   observacoes: string,
     *   com_grupos: bool,
     *   grupos: list<array{nome: ?string, blocos: list<array{codigo: string, titulo: string, itens: list<array{codigo: string, label: string, resposta: ?string}>}>}>
     * }
     */
    public function __invoke(Ocorrencia $ocorrencia, TipoChecklist $tipo): array
    {
        $ocorrencia->loadMissing([$tipo->relacao(), 'colaborador', 'enderecoVinculado']);

        /** @var OcorrenciaChecklistCivil|OcorrenciaChecklistEletrica $checklist */
        $checklist = $ocorrencia->{$tipo->relacao()};

        $data = $ocorrencia->data_saida ?? $checklist->updated_at;

        return [
            'titulo' => $tipo->titulo(),
            'rotulo_nao_aplica' => $tipo->rotuloNaoAplica(),
            'agencia' => $this->agencia($ocorrencia),
            'responsavel_tecnico' => $ocorrencia->prestador_nome ?: ($ocorrencia->colaborador?->nome_exibicao ?? ''),
            'data' => $data->format('d/m/Y'),
            'observacoes' => (string) ($checklist->observacoes ?? ''),
            'com_grupos' => collect($tipo->blocos())->contains(fn (ChecklistBlocoContract $bloco) => $bloco->grupo() !== null),
            'grupos' => $this->grupos($checklist, $tipo),
        ];
    }

    private function agencia(Ocorrencia $ocorrencia): string
    {
        $endereco = $ocorrencia->enderecoVinculado;

        if ($endereco !== null && $ocorrencia->agencia) {
            return $endereco->numero.' - '.$ocorrencia->agencia;
        }

        if ($endereco !== null) {
            return (string) $endereco->numero;
        }

        return (string) ($ocorrencia->agencia ?? '');
    }

    /**
     * Blocos agrupados pelo grupo lateral. Checklists sem grupo ficam num único grupo com nome null.
     *
     * @return list<array{nome: ?string, blocos: list<array{codigo: string, titulo: string, itens: list<array{codigo: string, label: string, resposta: ?string}>}>}>
     */
    private function grupos(OcorrenciaChecklistCivil|OcorrenciaChecklistEletrica $checklist, TipoChecklist $tipo): array
    {
        $grupos = [];

        foreach ($tipo->blocos() as $bloco) {
            $itens = array_map(fn (ChecklistItemContract $item) => [
                'codigo' => $item->codigo(),
                'label' => $item->label(),
                'resposta' => ($checklist->{$bloco->value}[$item->codigo()] ?? null)?->value,
            ], $bloco->itens());

            $chave = $bloco->grupo() ?? '';

            $grupos[$chave]['nome'] = $bloco->grupo();
            $grupos[$chave]['blocos'][] = [
                'codigo' => $bloco->codigo(),
                'titulo' => $bloco->label(),
                'itens' => $itens,
            ];
        }

        return array_values($grupos);
    }
}
