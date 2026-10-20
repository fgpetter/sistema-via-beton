<?php

namespace App\Actions\Programadas;

use App\Models\Programada;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Throwable;

class BuildVistoriaPdfDataFromProgramada
{
    public function __invoke(Programada $programada): array
    {
        $programada->loadMissing(['enderecoVinculado', 'imagens', 'responsavelEngenharia']);
        $endereco = $programada->enderecoVinculado;
        $codigoNomeLocal = $endereco && $programada->agencia
            ? $endereco->numero.' - '.$programada->agencia
            : ($endereco?->numero ?? $programada->agencia);
        $disk = Storage::disk('public');
        $pares = [];
        foreach ($programada->fotoPares() as $numero => $par) {
            $pares[$numero] = [
                'antes' => $this->resolverImagem($par['antes']?->path, $par['antes']?->legenda, $disk),
                'depois' => $this->resolverImagem($par['depois']?->path, $par['depois']?->legenda, $disk),
            ];
        }

        return [
            'requisicao' => (string) $programada->id,
            'tipo_programada' => $programada->tipo->label(),
            'numero_contrato' => (string) ($programada->contrato ?? ''),
            'responsavel_engenharia_banrisul' => $programada->responsavelEngenharia?->nome ?? '',
            'codigo_nome_local' => (string) $codigoNomeLocal,
            'endereco' => $endereco?->endereco ?? '',
            'titulo_relatorio' => 'RELATÓRIO TÉCNICO FOTOGRÁFICO',
            'descricao' => trim((string) $programada->descricao),
            'pares' => $pares,
        ];
    }

    private function resolverImagem(?string $path, ?string $legenda, FilesystemAdapter $disk): ?array
    {
        if ($path === null || $disk->missing($path)) {
            return null;
        }
        try {
            $src = 'data:'.($disk->mimeType($path) ?: 'image/jpeg').';base64,'.base64_encode($disk->get($path));
        } catch (Throwable) {
            return null;
        }

        return ['src' => $src, 'legenda' => (string) ($legenda ?? '')];
    }
}
