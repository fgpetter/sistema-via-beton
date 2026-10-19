<?php

namespace App\Actions\Programadas;

use App\Models\Programada;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Throwable;

class BuildVistoriaPdfDataFromProgramada
{
    /**
     * @return array{
     *   numero_programada: string,
     *   numero_contrato: string,
     *   responsavel_engenharia_banrisul: string,
     *   codigo_nome_local: string,
     *   endereco: string,
     *   titulo_relatorio: string,
     *   descricao: string,
     *   imagens: array<int, array{src: string, legenda: string, recusada: bool}>,
     *   incluirRecusadas: true,
     * }
     */
    public function __invoke(Programada $programada): array
    {
        $programada->loadMissing(['enderecoVinculado', 'imagens', 'responsavelEngenharia']);

        $endereco = $programada->enderecoVinculado;
        $codigoNomeLocal = '';
        if ($endereco !== null && $programada->agencia) {
            $codigoNomeLocal = $endereco->numero.' - '.$programada->agencia;
        } elseif ($endereco !== null) {
            $codigoNomeLocal = (string) $endereco->numero;
        } elseif ($programada->agencia) {
            $codigoNomeLocal = $programada->agencia;
        }

        $enderecoTexto = $endereco?->endereco ?? '';

        $disk = Storage::disk('public');
        $imagens = [];

        foreach ($programada->imagens as $imagem) {
            $dadosImagem = $this->resolverImagemParaPdf($imagem->path, $imagem->legenda, $disk);
            if ($dadosImagem !== null) {
                $dadosImagem['recusada'] = $imagem->recusada;
                $imagens[] = $dadosImagem;
            }
        }

        return [
            'numero_programada' => (string) $programada->id,
            'tipo_programada' => $programada->tipo->label(),
            'numero_contrato' => (string) ($programada->contrato ?? ''),
            'responsavel_engenharia_banrisul' => $programada->responsavelEngenharia?->nome ?? '',
            'codigo_nome_local' => $codigoNomeLocal,
            'endereco' => $enderecoTexto,
            'titulo_relatorio' => 'RELATÓRIO TÉCNICO FOTOGRÁFICO',
            'descricao' => trim((string) $programada->descricao),
            'imagens' => $imagens,
            'incluirRecusadas' => true,
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
