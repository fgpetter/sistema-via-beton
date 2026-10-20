<?php

namespace App\Livewire\Admin;

use App\Enums\TipoImagemOcorrencia;
use App\Jobs\ProcessarImagemOcorrencia;
use App\Jobs\ProcessarImagemProgramada;
use App\Models\Ocorrencia;
use App\Models\OcorrenciaImagem;
use App\Models\Programada;
use App\Models\ProgramadaImagem;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class FotoGaleria extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    #[Locked]
    public string $registroTipo;

    #[Locked]
    public int $registroId;

    public $fotoUpload;

    public ?int $uploadingPar = null;

    public ?string $uploadingTipo = null;

    public bool $dropzoneHabilitado = true;

    public function mount(string $registroTipo, int $registroId): void
    {
        abort_unless(in_array($registroTipo, ['ocorrencia', 'programada'], true), 404);

        $this->registroTipo = $registroTipo;
        $this->registroId = $registroId;
        $this->ensureUserIsAuthorized();
        $this->registroQuery()->findOrFail($registroId);
    }

    #[Computed]
    public function registro(): Ocorrencia|Programada
    {
        return $this->registroQuery()
            ->with('imagens')
            ->findOrFail($this->registroId);
    }

    #[Computed]
    public function fotoPares(): array
    {
        $maxPar = (int) $this->registro->imagens->max('par');

        return $this->registro->fotoPares(max(1, $maxPar + 1));
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

    public function updatedFotoUpload(): void
    {
        if (! $this->fotoUpload || $this->uploadingPar === null || ! $this->uploadingTipo) {
            return;
        }

        $this->ensureUserIsAuthorized();
        $this->validate(['fotoUpload' => ['image', 'max:5120']]);

        $tipo = TipoImagemOcorrencia::from($this->uploadingTipo);
        $par = $tipo === TipoImagemOcorrencia::Antes
            ? $this->resolverParAntes($this->uploadingPar)
            : $this->uploadingPar;

        if ($tipo === TipoImagemOcorrencia::Depois && ! $this->parTemFotoAntes($par)) {
            $this->reset(['fotoUpload']);
            $this->swalToastError(SwalToast::errorOptions(
                'É necessário uma foto Antes para enviar a foto Depois.'
            ));

            return;
        }

        $path = $this->fotoUpload->store("{$this->registroTipo}s/{$this->registroId}/{$tipo->value}", 'public');
        $imagem = $this->imagemClass()::create([
            $this->foreignKey() => $this->registroId,
            'tipo' => $tipo,
            'par' => $par,
            'path' => $path,
        ]);

        if ($this->registroTipo === 'ocorrencia') {
            ProcessarImagemOcorrencia::dispatch($imagem);
        } else {
            ProcessarImagemProgramada::dispatch($imagem);
        }

        $this->reset(['fotoUpload']);
        unset($this->registro, $this->fotoPares);

        if ($this->registroTipo === 'programada') {
            $this->dispatch('programada-imagens-atualizadas');
        }

        $this->swalToastSuccess(SwalToast::successOptions('Foto enviada!'));
    }

    public function salvarLegenda(int $imagemId, string $legenda): void
    {
        $this->ensureUserIsAuthorized();
        $this->imagemQuery()->findOrFail($imagemId)->update(['legenda' => $legenda]);
        unset($this->registro, $this->fotoPares);
    }

    public function removerImagem(int $imagemId): void
    {
        $this->ensureUserIsAuthorized();
        $imagem = $this->imagemQuery()->findOrFail($imagemId);

        Storage::disk('public')->delete($imagem->path);
        $imagem->delete();
        unset($this->registro, $this->fotoPares);

        if ($this->registroTipo === 'programada') {
            $this->dispatch('programada-imagens-atualizadas');
        }
    }

    public function render(): View
    {
        return view('livewire.admin.foto-galeria');
    }

    protected function resolverParAntes(int $parSugerido): int
    {
        if (! $this->parTemFotoAntes($parSugerido)) {
            return $parSugerido;
        }

        return $this->registro->proximoPar();
    }

    protected function parTemFotoAntes(int $par): bool
    {
        return $this->imagemQuery()
            ->where('par', $par)
            ->where('tipo', TipoImagemOcorrencia::Antes)
            ->exists();
    }

    protected function ensureUserIsAuthorized(): void
    {
        /** @var User|null $user */
        $user = auth()->user();
        abort_unless($user?->isAdmin(), 403, 'Você não tem permissão para acessar esta funcionalidade.');
    }

    protected function registroQuery(): Builder
    {
        $model = $this->registroTipo === 'programada' ? Programada::class : Ocorrencia::class;

        return $model::query();
    }

    protected function imagemQuery(): Builder
    {
        return $this->imagemClass()::query()->where($this->foreignKey(), $this->registroId);
    }

    protected function imagemClass(): string
    {
        return $this->registroTipo === 'programada' ? ProgramadaImagem::class : OcorrenciaImagem::class;
    }

    protected function foreignKey(): string
    {
        return $this->registroTipo === 'programada' ? 'programada_id' : 'ocorrencia_id';
    }
}
