<?php

namespace App\Actions\Ocorrencias;

use App\Models\Ocorrencia;
use App\Models\Prazo;
use Illuminate\Support\Carbon;

class BuildRatPdfDataFromOcorrencia
{
    /**
     * @return array<string, string>
     */
    public function __invoke(Ocorrencia $ocorrencia, ?Carbon $geradoEm = null): array
    {
        $geradoEm ??= now();

        $ocorrencia->loadMissing([
            'prazo',
            'colaborador',
            'enderecoVinculado',
            'responsavelEngenharia',
            'disciplina',
            'subdisciplina1',
            'subdisciplina2',
            'subdisciplina3',
        ]);

        $timezoneApp = (string) config('app.timezone');
        $dataSaidaPdf = ($ocorrencia->data_saida ?? $geradoEm)->copy()->timezone($timezoneApp);

        $prazo = $ocorrencia->prazo;
        $prazoAtendimento = '';
        if ($prazo !== null) {
            $prazoAtendimento = (string) $prazo->prazo_valor.$prazo->prazo_unidade->value;
        }

        $emergencial = $prazo !== null && $prazo->nome === Prazo::EMERGENCIAL ? 'Sim' : 'Não';

        $endereco = $ocorrencia->enderecoVinculado;
        $codigoNomeLocal = '';
        if ($endereco !== null && $ocorrencia->agencia) {
            $codigoNomeLocal = $endereco->numero.' - '.$ocorrencia->agencia;
        } elseif ($endereco !== null) {
            $codigoNomeLocal = (string) $endereco->numero;
        } elseif ($ocorrencia->agencia) {
            $codigoNomeLocal = $ocorrencia->agencia;
        }

        $enderecoTexto = $endereco?->endereco ?? '';

        $titulo = (string) $ocorrencia->titulo;
        $descricao = (string) ($ocorrencia->descricao ?? '');
        $itemDescricao = $titulo."\n\n".$descricao;

        return [
            'numero_ocorrencia' => (string) $ocorrencia->id,
            'emergencial' => $emergencial,
            'prazo_atendimento' => $prazoAtendimento,
            'numero_contrato' => (string) ($ocorrencia->contrato ?? ''),
            'responsavel_engenharia_banrisul' => $ocorrencia->responsavelEngenharia?->nome ?? '',
            'usuario_final_afetado' => (string) ($ocorrencia->agencia ?? ''),
            'data_abertura' => $ocorrencia->abertura?->format('d/m/Y') ?? '',
            'violacao_projetada' => $ocorrencia->violacao_projetada?->copy()->timezone($timezoneApp)->format('d/m/Y - H:i') ?? '',
            'prioridade' => (string) ($ocorrencia->prioridade ?? ''),
            'usuario_final_afetado_col5' => (string) ($ocorrencia->agencia ?? ''),
            'codigo_nome_local' => $codigoNomeLocal,
            'endereco' => $enderecoTexto,
            'disciplina' => (string) ($ocorrencia->disciplina?->disciplina ?? ''),
            'subdisciplina_1' => (string) ($ocorrencia->subdisciplina1?->disciplina ?? ''),
            'subdisciplina_2' => (string) ($ocorrencia->subdisciplina2?->disciplina ?? ''),
            'subdisciplina_3' => (string) ($ocorrencia->subdisciplina3?->disciplina ?? ''),
            'item_descricao_servico' => $itemDescricao,
            'situacao_codigo' => '',
            'comentarios_prestador' => $ocorrencia->comentarios_prestador ?? '',
            'data_chegada' => $ocorrencia->data_chegada?->format('d/m/Y') ?? '',
            'data_saida' => $dataSaidaPdf->format('d/m/Y'),
            'identificacao_representante' => (string) ($ocorrencia->colaborador?->nome ?? ''),
            'assinatura_representante' => '',
            'carimbo_banrisul' => '',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function mockForPreview(): array
    {
        return [
            'numero_ocorrencia' => '42',
            'emergencial' => 'Não',
            'prazo_atendimento' => '6hora',
            'numero_contrato' => '0100557/2025',
            'responsavel_engenharia_banrisul' => 'Dustin Hofman',
            'usuario_final_afetado' => 'AG ACEGUA',
            'data_abertura' => '15/01/2026',
            'violacao_projetada' => '16/01/2026 - 18:00',
            'prioridade' => 'Alta',
            'usuario_final_afetado_col5' => 'AG ACEGUA',
            'codigo_nome_local' => '112 - AG ACEGUA',
            'endereco' => 'Rua Exemplo, 100 - Centro',
            'disciplina' => 'Elétrica',
            'subdisciplina_1' => 'Tomada',
            'subdisciplina_2' => 'Interruptor',
            'subdisciplina_3' => '',
            'item_descricao_servico' => "Manutenção preventiva no ar condicionado\n\nSubstituição de filtros e verificação do sistema de refrigeração.",
            'situacao_codigo' => '',
            'comentarios_prestador' => 'Comentários do prestador',
            'data_chegada' => '20/03/2026',
            'data_saida' => '20/03/2026',
            'identificacao_representante' => 'Carlos Adriano Vidal',
            'assinatura_representante' => '',
            'carimbo_banrisul' => '',
        ];
    }
}
