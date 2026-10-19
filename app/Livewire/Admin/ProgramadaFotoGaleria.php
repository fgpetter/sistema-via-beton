<?php

namespace App\Livewire\Admin;

use App\Jobs\ProcessarImagemProgramada;
use App\Models\Programada;
use App\Models\ProgramadaImagem;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class ProgramadaFotoGaleria extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    #[Locked]
    public int $programadaId;

    public $fotoUpload;

    public bool $dropzoneHabilitado = false;

    public function mount(int $programadaId): void
    {
        $this->programadaId = $programadaId;
        $this->ensureUserIsAuthorized();

        Programada::query()->where('id', $this->programadaId)->firstOrFail();
    }

    #[Computed]
    public function programada(): Programada
    {
        return Programada::query()
            ->with(['imagens'])
            ->findOrFail($this->programadaId);
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

        $path = $this->fotoUpload->store("programadas/{$this->programadaId}", 'public');

        $proximoPosition = (int) ProgramadaImagem::query()
            ->where('programada_id', $this->programadaId)
            ->max('position');

        $imagem = ProgramadaImagem::create([
            'programada_id' => $this->programadaId,
            'path' => $path,
            'position' => $proximoPosition + 1,
        ]);

        ProcessarImagemProgramada::dispatch($imagem);

        $this->reset(['fotoUpload']);
        unset($this->programada);

        $this->dispatch('programada-imagens-atualizadas');
        $this->swalToastSuccess(SwalToast::successOptions('Foto enviada!'));
    }

    public function salvarLegenda(int $imagemId, string $legenda): void
    {
        $this->ensureUserIsAuthorized();

        $imagem = ProgramadaImagem::query()
            ->where('id', $imagemId)
            ->where('programada_id', $this->programadaId)
            ->firstOrFail();

        $imagem->update(['legenda' => $legenda]);

        unset($this->programada);
        $this->dispatch('programada-imagens-atualizadas');
    }

    public function toggleRecusada(int $imagemId): void
    {
        $this->ensureUserIsAuthorized();

        $imagem = ProgramadaImagem::query()
            ->where('id', $imagemId)
            ->where('programada_id', $this->programadaId)
            ->firstOrFail();

        $imagem->update(['recusada' => ! $imagem->recusada]);

        unset($this->programada);
        $this->dispatch('programada-imagens-atualizadas');
    }

    public function reordenarImagens(int $imagemId, int $position): void
    {
        $this->ensureUserIsAuthorized();

        $imagens = ProgramadaImagem::query()
            ->where('programada_id', $this->programadaId)
            ->orderBy('position')
            ->orderBy('id')
            ->get();

        $movida = $imagens->firstWhere('id', $imagemId);

        if (! $movida) {
            abort(404);
        }

        $ordenadas = $imagens->where('id', '!=', $imagemId)->values();
        $ordenadas->splice($position, 0, [$movida]);

        foreach ($ordenadas as $index => $imagem) {
            $imagem->update(['position' => $index + 1]);
        }

        unset($this->programada);
        $this->dispatch('programada-imagens-atualizadas');
    }

    public function removerImagem(int $imagemId): void
    {
        $this->ensureUserIsAuthorized();

        $imagem = ProgramadaImagem::query()
            ->where('programada_id', $this->programadaId)
            ->findOrFail($imagemId);

        Storage::disk('public')->delete($imagem->path);
        $imagem->delete();
        unset($this->programada);
        $this->dispatch('programada-imagens-atualizadas');
    }

    public function render(): View
    {
        return view('livewire.admin.programada-foto-galeria');
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
