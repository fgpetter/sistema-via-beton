<?php

namespace App\Livewire\Admin;

use App\Enums\TipoImagemOcorrencia;
use App\Jobs\ProcessarImagemOcorrencia;
use App\Models\Ocorrencia;
use App\Models\OcorrenciaImagem;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class OcorrenciaFotoGaleria extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    #[Locked]
    public int $ocorrenciaId;

    public $fotoUpload;

    public ?int $uploadingPar = null;

    public ?string $uploadingTipo = null;

    public int $totalPares = 1;

    public bool $dropzoneHabilitado = false;

    public function mount(int $ocorrenciaId): void
    {
        $this->ocorrenciaId = $ocorrenciaId;
        $this->ensureUserIsAuthorized();

        Ocorrencia::query()->where('id', $this->ocorrenciaId)->firstOrFail();

        $maxPar = (int) OcorrenciaImagem::query()
            ->where('ocorrencia_id', $this->ocorrenciaId)
            ->max('par');
        $this->totalPares = max(1, $maxPar);
    }

    #[Computed]
    public function ocorrencia(): Ocorrencia
    {
        return Ocorrencia::query()
            ->with('imagens')
            ->findOrFail($this->ocorrenciaId);
    }

    #[Computed]
    public function fotoPares(): array
    {
        return $this->ocorrencia->fotoPares($this->totalPares);
    }

    public function placeholder(): string
    {
        return <<<'HTML'
<div class="border border-blue-200 rounded-md bg-blue-50 animate-pulse">
    <div class="w-full px-4 py-3 flex justify-between items-center">
        <div class="h-4 bg-default-200 rounded w-20"></div>
        <div class="size-4 bg-default-200 rounded"></div>
    </div>
    <div class="px-4 pb-4 space-y-3">
        <div class="grid grid-cols-2 gap-3">
            <div class="aspect-square bg-default-200 rounded"></div>
            <div class="aspect-square bg-default-200 rounded"></div>
        </div>
    </div>
</div>
HTML;
    }

    public function adicionarPar(): void
    {
        $this->ensureUserIsAuthorized();
        $this->totalPares++;
    }

    public function updatedFotoUpload(): void
    {
        if (! $this->fotoUpload || $this->uploadingPar === null || ! $this->uploadingTipo) {
            return;
        }

        $this->ensureUserIsAuthorized();
        $this->validate(['fotoUpload' => ['image', 'max:5120']]);

        $traceId = (string) Str::uuid();
        $tipo = TipoImagemOcorrencia::from($this->uploadingTipo);
        Log::info('ocorrencia_imagem.upload.iniciado', [
            'trace_id' => $traceId,
            'origem' => 'admin',
            'ocorrencia_id' => $this->ocorrenciaId,
            'tipo' => $tipo->value,
            'par' => $this->uploadingPar,
            'arquivo_original' => $this->fotoUpload->getClientOriginalName(),
        ]);

        $path = $this->fotoUpload->store("ocorrencias/{$this->ocorrenciaId}/{$tipo->value}", 'public');
        Log::info('ocorrencia_imagem.upload.salvo_storage', [
            'trace_id' => $traceId,
            'origem' => 'admin',
            'ocorrencia_id' => $this->ocorrenciaId,
            'path' => $path,
        ]);

        $imagem = OcorrenciaImagem::create([
            'ocorrencia_id' => $this->ocorrenciaId,
            'tipo' => $tipo,
            'par' => $this->uploadingPar,
            'path' => $path,
        ]);
        Log::info('ocorrencia_imagem.upload.salvo_banco', [
            'trace_id' => $traceId,
            'origem' => 'admin',
            'ocorrencia_id' => $this->ocorrenciaId,
            'imagem_id' => $imagem->id,
            'path' => $imagem->path,
        ]);

        ProcessarImagemOcorrencia::dispatch($imagem, $traceId);
        Log::info('ocorrencia_imagem.job.dispatch', [
            'trace_id' => $traceId,
            'origem' => 'admin',
            'ocorrencia_id' => $this->ocorrenciaId,
            'imagem_id' => $imagem->id,
            'job' => ProcessarImagemOcorrencia::class,
        ]);

        $this->reset(['fotoUpload', 'uploadingPar', 'uploadingTipo']);
        unset($this->ocorrencia, $this->fotoPares);

        $this->swalToastSuccess(SwalToast::successOptions('Foto enviada!'));
    }

    public function salvarLegenda(int $imagemId, string $legenda): void
    {
        $this->ensureUserIsAuthorized();

        $imagem = OcorrenciaImagem::query()
            ->where('id', $imagemId)
            ->where('ocorrencia_id', $this->ocorrenciaId)
            ->firstOrFail();

        $imagem->update(['legenda' => $legenda]);

        unset($this->ocorrencia, $this->fotoPares);
    }

    public function removerImagem(int $imagemId): void
    {
        $this->ensureUserIsAuthorized();

        $imagem = OcorrenciaImagem::query()
            ->where('ocorrencia_id', $this->ocorrenciaId)
            ->findOrFail($imagemId);

        Storage::disk('public')->delete($imagem->path);
        $imagem->delete();
        unset($this->ocorrencia, $this->fotoPares);
    }

    public function render(): View
    {
        return view('livewire.admin.ocorrencia-foto-galeria');
    }

    protected function ensureUserIsAuthorized(): void
    {
        /** @var User|null $user */
        $user = auth()->user();
        if (! $user?->isAdmin()) {
            abort(403, 'Você não tem permissão para acessar esta funcionalidade.');
        }
    }
}
