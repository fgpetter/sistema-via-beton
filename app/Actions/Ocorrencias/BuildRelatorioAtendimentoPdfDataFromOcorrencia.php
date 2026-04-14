<?php

namespace App\Actions\Ocorrencias;

use App\Models\Ocorrencia;
use App\Models\Prazo;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Throwable;

class BuildRelatorioAtendimentoPdfDataFromOcorrencia
{
    /**
     * @return array{
     *   numero_ocorrencia: string,
     *   emergencial: string,
     *   prazo_atendimento: string,
     *   numero_contrato: string,
     *   responsavel_engenharia_banrisul: string,
     *   codigo_nome_local: string,
     *   endereco: string,
     *   pares: array<int, array{antes: array{src: string, legenda: string}|null, depois: array{src: string, legenda: string}|null}>
     * }
     */
    public function __invoke(Ocorrencia $ocorrencia): array
    {
        $ocorrencia->loadMissing(['prazo', 'enderecoVinculado', 'imagens']);

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

        $disk = Storage::disk('public');
        $pares = [];

        foreach ($ocorrencia->fotoPares() as $numero => $par) {
            $pares[$numero] = [
                'antes' => $this->resolverImagemParaPdf($par['antes']?->path, $par['antes']?->legenda, $disk),
                'depois' => $this->resolverImagemParaPdf($par['depois']?->path, $par['depois']?->legenda, $disk),
            ];
        }

        return [
            'numero_ocorrencia' => (string) $ocorrencia->id,
            'emergencial' => $emergencial,
            'prazo_atendimento' => $prazoAtendimento,
            'numero_contrato' => (string) ($ocorrencia->contrato ?? ''),
            'responsavel_engenharia_banrisul' => '',
            'codigo_nome_local' => $codigoNomeLocal,
            'endereco' => $enderecoTexto,
            'pares' => $pares,
        ];
    }

    /**
     * @return array{src: string, legenda: string}|null
     */
    private function resolverImagemParaPdf(?string $path, ?string $legenda, FilesystemAdapter $disk): ?array
    {
        if ($path === null || $disk->missing($path)) {
            return null;
        }

        try {
            $conteudo = $disk->get($path);
            $mime = $disk->mimeType($path) ?: 'image/jpeg';
        } catch (Throwable) {
            return null;
        }

        $src = 'data:'.$mime.';base64,'.base64_encode($conteudo);

        return [
            'src' => $src,
            'legenda' => (string) ($legenda ?? ''),
        ];
    }

    /**
     * @return array{
     *   numero_ocorrencia: string,
     *   emergencial: string,
     *   prazo_atendimento: string,
     *   numero_contrato: string,
     *   responsavel_engenharia_banrisul: string,
     *   codigo_nome_local: string,
     *   endereco: string,
     *   pares: array<int, array{antes: array{src: string, legenda: string}|null, depois: array{src: string, legenda: string}|null}>
     * }
     */
    public static function mockForPreview(): array
    {
        return [
            'numero_ocorrencia' => '9384412',
            'emergencial' => 'Não',
            'prazo_atendimento' => '20dia',
            'numero_contrato' => '0100557/2025',
            'responsavel_engenharia_banrisul' => 'Dustin Hofmann',
            'codigo_nome_local' => '0380 - São Borja',
            'endereco' => 'Rua General Osório - 2034',
            'pares' => [],
        ];
    }
}
