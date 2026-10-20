<?php

namespace App\Livewire\Admin;

use App\Enums\ProgramadaStatus;
use App\Enums\ProgramadaTipo;
use App\Models\Programada;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

#[Layout('layouts.vertical')]
#[Title('Gestão de Programadas')]
class ProgramadasList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    #[Url(as: 'busca')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $statusFilter = '';

    #[Url(as: 'tipo')]
    public string $tipoFilter = '';

    public bool $showDeleteModal = false;

    public ?int $deletingId = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedTipoFilter(): void
    {
        $this->resetPage();
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function programadas()
    {
        return Programada::query()
            ->semRascunho()
            ->with(['colaborador.user', 'concluidoPor', 'enderecoVinculado'])
            ->withCount('imagens')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('titulo', 'like', "%{$this->search}%")
                        ->orWhere('agencia', 'like', "%{$this->search}%")
                        ->orWhereHas('colaborador', function ($colaboradorQuery) {
                            $colaboradorQuery->where('nome', 'like', "%{$this->search}%");
                        });

                    if (is_numeric($this->search)) {
                        $q->orWhere('id', (int) $this->search);
                    }
                });
            })
            ->when($this->tipoFilter, function ($query) {
                $tipo = ProgramadaTipo::tryFrom($this->tipoFilter);
                if ($tipo) {
                    $query->where('tipo', $tipo);
                }
            })
            ->when($this->statusFilter, function ($query) {
                $status = ProgramadaStatus::tryFrom($this->statusFilter);
                if ($status) {
                    $query->status($status);
                }
            })
            ->orderByDesc('abertura')
            ->paginate(10);
    }

    #[Computed]
    public function statuses(): array
    {
        return ProgramadaStatus::options();
    }

    #[Computed]
    public function tipos(): array
    {
        return ProgramadaTipo::options();
    }

    #[On('programada-saved')]
    public function handleProgramadaSaved(): void
    {
        $this->resetPage();
        unset($this->programadas);
    }

    public function confirmDelete(int $programadaId): void
    {
        $this->ensureUserIsAuthorized();
        $this->deletingId = $programadaId;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $this->ensureUserIsAuthorized();

        if (! $this->deletingId) {
            return;
        }

        $deletedId = $this->deletingId;

        Programada::findOrFail($deletedId)->delete();

        unset($this->programadas);
        $this->swalToastSuccess(SwalToast::successOptions('Excluído com sucesso!'));

        $this->closeDeleteModal();
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
        $this->deletingId = null;
    }

    protected function ensureUserIsAuthorized(): void
    {
        /** @var User|null $user */
        $user = auth()->user();
        if (! $user?->isAdmin()) {
            abort(403, 'Você não tem permissão para acessar esta funcionalidade.');
        }
    }

    public function render(): View
    {
        return view('livewire.admin.programadas-list');
    }
}
