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

        $ocorrencia->loadMissing(['prazo', 'colaborador', 'enderecoVinculado']);

        $timezoneApp = (string) config('app.timezone');
        $datahoraSaidaPdf = ($ocorrencia->datahora_saida ?? $geradoEm)->copy()->timezone($timezoneApp);

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
            'responsavel_engenharia_banrisul' => '',
            'usuario_final_afetado' => (string) ($ocorrencia->agencia ?? ''),
            'data_abertura' => $ocorrencia->abertura?->format('d/m/Y') ?? '',
            'violacao_projetada' => $ocorrencia->violacao_projetada?->copy()->timezone($timezoneApp)->format('d/m/Y - H:i') ?? '',
            'prioridade' => (string) ($ocorrencia->prioridade ?? ''),
            'usuario_final_afetado_col5' => (string) ($ocorrencia->agencia ?? ''),
            'codigo_nome_local' => $codigoNomeLocal,
            'endereco' => $enderecoTexto,
            'item_descricao_servico' => $itemDescricao,
            'situacao_codigo' => '',
            'observacoes' => '',
            'datahora_chegada' => $ocorrencia->datahora_chegada?->copy()->timezone($timezoneApp)->format('d/m/Y - H:i') ?? '',
            'datahora_saida' => $datahoraSaidaPdf->format('d/m/Y - H:i'),
            'prazo_atendimento_rodape' => $prazoAtendimento,
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
            'responsavel_engenharia_banrisul' => '',
            'usuario_final_afetado' => 'AG ACEGUA',
            'data_abertura' => '15/01/2026',
            'violacao_projetada' => '16/01/2026 - 18:00',
            'prioridade' => 'Alta',
            'usuario_final_afetado_col5' => 'AG ACEGUA',
            'codigo_nome_local' => '112 - AG ACEGUA',
            'endereco' => 'Rua Exemplo, 100 - Centro',
            'item_descricao_servico' => "Manutenção preventiva no ar condicionado\n\nSubstituição de filtros e verificação do sistema de refrigeração.",
            'situacao_codigo' => '',
            'observacoes' => '',
            'datahora_chegada' => '20/03/2026 - 09:30',
            'datahora_saida' => '20/03/2026 - 17:45',
            'prazo_atendimento_rodape' => '6hora',
            'identificacao_representante' => 'Carlos Adriano Vidal',
            'assinatura_representante' => '',
            'carimbo_banrisul' => '',
        ];
    }
}
