<?php

namespace App\Livewire\Admin;

use App\Jobs\ProcessarImagemMedicaoProgramada;
use App\Models\Programada;
use App\Models\ProgramadaMedicaoImagem;
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

class ProgramadaMedicaoGaleria extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    public const MAX_DEPOIS_POR_ANTES = 3;

    #[Locked]
    public int $programadaId;

    public $fotoUpload;

    public ?int $uploadingAntesId = null;

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
            ->with(['imagensAceitasComMedicao'])
            ->findOrFail($this->programadaId);
    }

    #[Computed]
    public function totalMedicaoImagens(): int
    {
        return $this->programada->imagensAceitasComMedicao->sum(
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

    public function validarLoteDepois(int $programadaImagemId, int $quantidadeArquivos): bool
    {
        $this->ensureUserIsAuthorized();

        if ($quantidadeArquivos < 1) {
            return false;
        }

        if (! $this->podeAdicionarDepois($programadaImagemId, $quantidadeArquivos)) {
            $this->swalToastError(SwalToast::errorOptions(
                'Máximo de '.self::MAX_DEPOIS_POR_ANTES.' imagens permitidas na coluna Depois. Nenhuma imagem foi enviada.'
            ));

            return false;
        }

        return true;
    }

    public function updatedFotoUpload(): void
    {
        if (! $this->fotoUpload || $this->uploadingAntesId === null) {
            return;
        }

        $this->ensureUserIsAuthorized();
        $this->validate(['fotoUpload' => ['image', 'max:5120']]);

        $programadaImagemId = $this->uploadingAntesId;

        if (! $this->podeAdicionarDepois($programadaImagemId, 1)) {
            $this->reset(['fotoUpload']);
            $this->swalToastError(SwalToast::errorOptions(
                'Máximo de '.self::MAX_DEPOIS_POR_ANTES.' imagens permitidas na coluna Depois. Nenhuma imagem foi enviada.'
            ));

            return;
        }

        $path = $this->fotoUpload->store(
            "programadas/{$this->programadaId}/medicao/{$programadaImagemId}",
            'public'
        );

        $medicaoImagem = ProgramadaMedicaoImagem::create([
            'programada_imagem_id' => $programadaImagemId,
            'path' => $path,
        ]);

        ProcessarImagemMedicaoProgramada::dispatch($medicaoImagem);

        $this->reset(['fotoUpload']);
        unset($this->programada, $this->totalMedicaoImagens);

        $this->swalToastSuccess(SwalToast::successOptions('Foto enviada!'));
    }

    public function removerMedicaoImagem(int $medicaoImagemId): void
    {
        $this->ensureUserIsAuthorized();

        $imagem = ProgramadaMedicaoImagem::query()
            ->where('id', $medicaoImagemId)
            ->whereHas('programadaImagem', fn ($query) => $query->where('programada_id', $this->programadaId))
            ->firstOrFail();

        Storage::disk('public')->delete($imagem->path);
        $imagem->delete();

        unset($this->programada, $this->totalMedicaoImagens);
    }

    #[On('programada-imagens-atualizadas')]
    public function atualizarImagens(): void
    {
        unset($this->programada, $this->totalMedicaoImagens);
    }

    public function render(): View
    {
        return view('livewire.admin.programada-medicao-galeria');
    }

    protected function ensureUserIsAuthorized(): void
    {
        /** @var User|null $user */
        $user = auth()->user();
        if (! $user?->isAdmin()) {
            abort(403, 'Você não tem permissão para acessar esta funcionalidade.');
        }
    }

    protected function contarDepoisExistentes(int $programadaImagemId): int
    {
        return ProgramadaMedicaoImagem::query()
            ->where('programada_imagem_id', $programadaImagemId)
            ->whereHas('programadaImagem', fn ($query) => $query->where('programada_id', $this->programadaId))
            ->count();
    }

    protected function podeAdicionarDepois(int $programadaImagemId, int $quantidadeNovos): bool
    {
        return $this->contarDepoisExistentes($programadaImagemId) + $quantidadeNovos <= self::MAX_DEPOIS_POR_ANTES;
    }
}
