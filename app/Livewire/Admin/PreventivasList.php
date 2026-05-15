<?php

namespace App\Livewire\Admin;

use App\Enums\PreventivaStatus;
use App\Models\Preventiva;
use App\Models\User;
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
#[Title('Gestão de Preventivas')]
class PreventivasList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    #[Url(as: 'busca')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $statusFilter = '';

    public bool $showDeleteModal = false;

    public ?int $deletingId = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function preventivas()
    {
        return Preventiva::query()
            ->semRascunho()
            ->with(['colaborador.user', 'concluidoPor', 'enderecoVinculado'])
            ->withCount(['imagens', 'imagensRecusadas'])
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
            ->when($this->statusFilter, function ($query) {
                $status = PreventivaStatus::tryFrom($this->statusFilter);
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
        return PreventivaStatus::options();
    }

    #[On('preventiva-saved')]
    public function handlePreventivaSaved(): void
    {
        $this->resetPage();
        unset($this->preventivas);
    }

    public function confirmDelete(int $preventivaId): void
    {
        $this->ensureUserIsAuthorized();
        $this->deletingId = $preventivaId;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $this->ensureUserIsAuthorized();

        if (! $this->deletingId) {
            return;
        }

        $deletedId = $this->deletingId;

        Preventiva::findOrFail($deletedId)->delete();

        unset($this->preventivas);
        $this->swalToastWarning([
            'title' => 'Excluído com sucesso!',
            'showConfirmButton' => false,
            'position' => 'top-end',
            'timer' => 2000,
        ]);

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
        return view('livewire.admin.preventivas-list');
    }
}
