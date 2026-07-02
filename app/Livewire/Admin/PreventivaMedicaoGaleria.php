<?php

namespace App\Livewire\Admin;

use App\Jobs\ProcessarImagemMedicaoPreventiva;
use App\Models\Preventiva;
use App\Models\PreventivaMedicaoImagem;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class PreventivaMedicaoGaleria extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    #[Locked]
    public int $preventivaId;

    public $fotoUpload;

    public ?int $uploadingAntesId = null;

    public bool $dropzoneHabilitado = false;

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
            ->with(['imagensAceitasComMedicao'])
            ->findOrFail($this->preventivaId);
    }

    #[Computed]
    public function totalMedicaoImagens(): int
    {
        return $this->preventiva->imagensAceitasComMedicao->sum(
            fn ($imagem) => $imagem->medicaoImagens->count()
        );
    }

    public function placeholder(): string
    {
        return <<<'HTML'
<div class="border border-blue-200 rounded-md bg-blue-50 animate-pulse">
    <div class="w-full px-4 py-3 flex justify-between items-center">
        <div class="h-4 bg-default-200 rounded w-40"></div>
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

    public function updatedFotoUpload(): void
    {
        if (! $this->fotoUpload || $this->uploadingAntesId === null) {
            return;
        }

        $this->ensureUserIsAuthorized();
        $this->validate(['fotoUpload' => ['image', 'max:5120']]);

        $preventivaImagemId = $this->uploadingAntesId;

        $path = $this->fotoUpload->store(
            "preventivas/{$this->preventivaId}/medicao/{$preventivaImagemId}",
            'public'
        );

        $medicaoImagem = PreventivaMedicaoImagem::create([
            'preventiva_imagem_id' => $preventivaImagemId,
            'path' => $path,
        ]);

        ProcessarImagemMedicaoPreventiva::dispatch($medicaoImagem);

        $this->reset(['fotoUpload']);
        unset($this->preventiva, $this->totalMedicaoImagens);

        $this->swalToastSuccess(SwalToast::successOptions('Foto enviada!'));
    }

    public function removerMedicaoImagem(int $medicaoImagemId): void
    {
        $this->ensureUserIsAuthorized();

        $imagem = PreventivaMedicaoImagem::query()
            ->where('id', $medicaoImagemId)
            ->whereHas('preventivaImagem', fn ($query) => $query->where('preventiva_id', $this->preventivaId))
            ->firstOrFail();

        Storage::disk('public')->delete($imagem->path);
        $imagem->delete();

        unset($this->preventiva, $this->totalMedicaoImagens);
    }

    #[On('preventiva-imagens-atualizadas')]
    public function atualizarImagens(): void
    {
        unset($this->preventiva, $this->totalMedicaoImagens);
    }

    public function render(): View
    {
        return view('livewire.admin.preventiva-medicao-galeria');
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
