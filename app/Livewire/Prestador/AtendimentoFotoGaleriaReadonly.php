<?php

namespace App\Livewire\Prestador;

use App\Models\Colaborador;
use App\Models\Ocorrencia;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class AtendimentoFotoGaleriaReadonly extends Component
{
    #[Locked]
    public int $ocorrenciaId;

    #[Locked]
    public string $collapseId;

    #[Locked]
    public string $wireKeyPrefix;

    #[Locked]
    public string $cardClass = 'card mb-4';

    #[Locked]
    public string $collapsePanelClass = 'hs-collapse w-full overflow-hidden transition-[height] duration-300';

    public function mount(
        int $ocorrenciaId,
        string $collapseId,
        string $wireKeyPrefix,
        string $cardClass = 'card mb-4',
        string $collapsePanelClass = 'hs-collapse w-full overflow-hidden transition-[height] duration-300',
    ): void {
        $this->ocorrenciaId = $ocorrenciaId;
        $this->collapseId = $collapseId;
        $this->wireKeyPrefix = $wireKeyPrefix;
        $this->cardClass = $cardClass;
        $this->collapsePanelClass = $collapsePanelClass;
        $this->ensureUserOwnsOcorrencia();
    }

    #[Computed]
    public function ocorrencia(): Ocorrencia
    {
        return Ocorrencia::query()
            ->with(['imagens', 'imagensAntes', 'imagensDepois'])
            ->findOrFail($this->ocorrenciaId);
    }

    public function placeholder(array $params = []): string
    {
        $cardClass = e($params['cardClass'] ?? 'card mb-4');

        return <<<HTML
<div class="{$cardClass} animate-pulse">
    <div class="card-header flex justify-between items-center gap-2">
        <div class="h-4 bg-default-200 rounded w-24"></div>
        <div class="flex gap-1">
            <div class="size-4 bg-default-200 rounded"></div>
            <div class="size-4 bg-default-200 rounded"></div>
        </div>
    </div>
    <div class="card-body pt-0 space-y-3">
        <div class="grid grid-cols-2 gap-3">
            <div class="aspect-square bg-default-200 rounded"></div>
            <div class="aspect-square bg-default-200 rounded"></div>
        </div>
    </div>
</div>
HTML;
    }

    public function render(): View
    {
        return view('livewire.prestador.atendimento-foto-galeria-readonly');
    }

    protected function ensureUserOwnsOcorrencia(): void
    {
        /** @var User $user */
        $user = auth()->user();
        $colaborador = $user->colaborador;
        $ocorrencia = Ocorrencia::query()->findOrFail($this->ocorrenciaId);

        if (! $colaborador instanceof Colaborador || $ocorrencia->colaborador_id !== $colaborador->id) {
            abort(403, 'Você não tem permissão para acessar esta ocorrência.');
        }
    }
}
