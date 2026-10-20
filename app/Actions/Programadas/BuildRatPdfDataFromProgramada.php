<?php

namespace App\Actions\Programadas;

use App\Enums\TipoColaborador;
use App\Models\Programada;
use Illuminate\Support\Carbon;

class BuildRatPdfDataFromProgramada
{
    public function __invoke(Programada $programada, ?Carbon $geradoEm = null): array
    {
        $geradoEm ??= now();
        $programada->loadMissing([
            'colaborador', 'enderecoVinculado', 'responsavelEngenharia', 'disciplina',
            'subdisciplina1', 'subdisciplina2', 'subdisciplina3', 'subdisciplina4', 'subdisciplina5', 'subdisciplina6',
        ]);
        $endereco = $programada->enderecoVinculado;
        $codigoNomeLocal = $endereco && $programada->agencia
            ? $endereco->numero.' - '.$programada->agencia
            : ($endereco?->numero ?? $programada->agencia);
        $colaborador = $programada->colaborador;
        $representante = $colaborador?->tipo === TipoColaborador::Administrativos && filled($programada->prestador_nome)
            ? $programada->prestador_nome
            : ($colaborador?->nome ?? '');

        return [
            'identificador_label' => 'Requisição',
            'numero_ocorrencia' => (string) $programada->id,
            'emergencial' => '',
            'prazo_atendimento' => '',
            'numero_contrato' => (string) ($programada->contrato ?? ''),
            'responsavel_engenharia_banrisul' => $programada->responsavelEngenharia?->nome ?? '',
            'usuario_final_afetado' => $programada->agencia,
            'data_abertura' => $programada->abertura?->format('d/m/Y') ?? '',
            'violacao_projetada' => '',
            'prioridade' => '',
            'usuario_final_afetado_col5' => $programada->agencia,
            'codigo_nome_local' => (string) $codigoNomeLocal,
            'endereco' => $endereco?->endereco ?? '',
            'disciplina' => $programada->disciplina?->disciplina ?? '',
            'subdisciplina_1' => $programada->subdisciplina1?->disciplina ?? '',
            'subdisciplina_2' => $programada->subdisciplina2?->disciplina ?? '',
            'subdisciplina_3' => $programada->subdisciplina3?->disciplina ?? '',
            'subdisciplina_4' => $programada->subdisciplina4?->disciplina ?? '',
            'subdisciplina_5' => $programada->subdisciplina5?->disciplina ?? '',
            'subdisciplina_6' => $programada->subdisciplina6?->disciplina ?? '',
            'item_descricao_servico' => $programada->titulo."\n\n".(string) ($programada->descricao ?? ''),
            'situacao_codigo' => '',
            'comentarios_prestador' => $programada->comentarios_prestador ?? '',
            'data_chegada' => $programada->data_chegada?->format('d/m/Y') ?? '',
            'data_saida' => ($programada->data_saida ?? $geradoEm)->format('d/m/Y'),
            'identificacao_representante' => (string) $representante,
            'assinatura_representante' => '',
            'carimbo_banrisul' => '',
        ];
    }
}
