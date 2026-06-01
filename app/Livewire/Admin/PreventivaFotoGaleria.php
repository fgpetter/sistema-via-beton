<?php

namespace App\Livewire\Admin;

use App\Jobs\ProcessarImagemPreventiva;
use App\Models\Preventiva;
use App\Models\PreventivaImagem;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class PreventivaFotoGaleria extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    #[Locked]
    public int $preventivaId;

    public $fotoUpload;

    public bool $isUploading = false;

    public function mount(int $preventivaId): void
    {
        $this->preventivaId = $preventivaId;
        $this->ensureUserIsAuthorized();

        Preventiva::query()->where('id', $this->preventivaId)->firstOrFail();
    }

    #[Computed]
    public function preventiva(): Preventiva
    {
        return Preventiva::query()
            ->with(['imagens'])
            ->findOrFail($this->preventivaId);
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
        <div class="grid grid-cols-3 gap-3">
            <div class="aspect-square bg-default-200 rounded"></div>
            <div class="aspect-square bg-default-200 rounded"></div>
            <div class="aspect-square bg-default-200 rounded"></div>
        </div>
    </div>
</div>
HTML;
    }

    public function updatedFotoUpload(): void
    {
        if (! $this->fotoUpload) {
            return;
        }

        $this->ensureUserIsAuthorized();
        $this->validate(['fotoUpload' => ['image', 'max:5120']]);

        $path = $this->fotoUpload->store("preventivas/{$this->preventivaId}", 'public');

        $imagem = PreventivaImagem::create([
            'preventiva_id' => $this->preventivaId,
            'path' => $path,
        ]);

        ProcessarImagemPreventiva::dispatch($imagem);

        $this->reset(['fotoUpload']);
        unset($this->preventiva);

        $this->swalToastSuccess(SwalToast::successOptions('Foto enviada!'));
    }

    public function salvarLegenda(int $imagemId, string $legenda): void
    {
        $this->ensureUserIsAuthorized();

        $imagem = PreventivaImagem::query()
            ->where('id', $imagemId)
            ->where('preventiva_id', $this->preventivaId)
            ->firstOrFail();

        $imagem->update(['legenda' => $legenda]);

        unset($this->preventiva);
    }

    public function toggleRecusada(int $imagemId): void
    {
        $this->ensureUserIsAuthorized();

        $imagem = PreventivaImagem::query()
            ->where('id', $imagemId)
            ->where('preventiva_id', $this->preventivaId)
            ->firstOrFail();

        $imagem->update(['recusada' => ! $imagem->recusada]);

        unset($this->preventiva);
    }

    public function removerImagem(int $imagemId): void
    {
        $this->ensureUserIsAuthorized();

        $imagem = PreventivaImagem::query()
            ->where('preventiva_id', $this->preventivaId)
            ->findOrFail($imagemId);

        Storage::disk('public')->delete($imagem->path);
        $imagem->delete();
        unset($this->preventiva);
    }

    public function render(): View
    {
        return view('livewire.admin.preventiva-foto-galeria');
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
