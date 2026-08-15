<?php

namespace App\Actions\Preventivas;

use App\Models\Preventiva;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Throwable;

class BuildRelatorioMedicaoPdfDataFromPreventiva
{
    /**
     * @return array{
     *   numero_preventiva: string,
     *   numero_contrato: string,
     *   responsavel_engenharia_banrisul: string,
     *   codigo_nome_local: string,
     *   endereco: string,
     *   titulo_relatorio: string,
     *   descricao: string,
     *   pares: array<int, array{
     *     antes: array{src: string, legenda: string}|null,
     *     depois: array<int, array{src: string}>
     *   }>,
     * }
     */
    public function __invoke(Preventiva $preventiva): array
    {
        $preventiva->loadMissing(['enderecoVinculado', 'imagensAceitasComMedicao', 'responsavelEngenharia']);

        $endereco = $preventiva->enderecoVinculado;
        $codigoNomeLocal = '';
        if ($endereco !== null && $preventiva->agencia) {
            $codigoNomeLocal = $endereco->numero.' - '.$preventiva->agencia;
        } elseif ($endereco !== null) {
            $codigoNomeLocal = (string) $endereco->numero;
        } elseif ($preventiva->agencia) {
            $codigoNomeLocal = $preventiva->agencia;
        }

        $enderecoTexto = $endereco?->endereco ?? '';

        $disk = Storage::disk('public');
        $pares = [];

        foreach ($preventiva->imagensAceitasComMedicao as $imagem) {
            $antes = $this->resolverImagemParaPdf($imagem->path, $imagem->legenda, $disk);
            $depois = [];

            foreach ($imagem->medicaoImagens as $medicaoImagem) {
                $dadosDepois = $this->resolverImagemParaPdf($medicaoImagem->path, null, $disk);
                if ($dadosDepois !== null) {
                    $depois[] = ['src' => $dadosDepois['src']];
                }
            }

            $pares[] = [
                'antes' => $antes,
                'depois' => $depois,
            ];
        }

        return [
            'numero_preventiva' => (string) $preventiva->id,
            'numero_contrato' => (string) ($preventiva->contrato ?? ''),
            'responsavel_engenharia_banrisul' => $preventiva->responsavelEngenharia?->nome ?? '',
            'codigo_nome_local' => $codigoNomeLocal,
            'endereco' => $enderecoTexto,
            'titulo_relatorio' => 'RELATÓRIO DE MEDIÇÃO',
            'descricao' => trim((string) $preventiva->descricao),
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
}
