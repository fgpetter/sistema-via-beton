<?php

namespace App\Livewire\Admin;

use App\Enums\OcorrenciaStatus;
use App\Livewire\Admin\Forms\OcorrenciaForm;
use App\Mail\OcorrenciaCriada;
use App\Models\Colaborador;
use App\Models\Ocorrencia;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

#[Layout('layouts.vertical')]
#[Title('Gestão de Ocorrências')]
class OcorrenciasList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public OcorrenciaForm $form;

    #[Url(as: 'busca')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $statusFilter = '';

    public bool $showModal = false;

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
    public function ocorrencias()
    {
        return Ocorrencia::query()
            ->with('colaborador')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('titulo', 'like', "%{$this->search}%")
                        ->orWhere('agencia', 'like', "%{$this->search}%")
                        ->orWhereHas('colaborador', function ($colaboradorQuery) {
                            $colaboradorQuery->where('nome', 'like', "%{$this->search}%");
                        });
                });
            })
            ->when($this->statusFilter, function ($query) {
                $status = OcorrenciaStatus::tryFrom($this->statusFilter);
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
        return OcorrenciaStatus::options();
    }

    #[Computed]
    public function colaboradores(): array
    {
        return Colaborador::query()
            ->orderBy('nome')
            ->get()
            ->mapWithKeys(fn (Colaborador $colaborador) => [
                $colaborador->id => $colaborador->nome,
            ])
            ->toArray();
    }

    public function openCreateModal(): void
    {
        $this->ensureUserIsAuthorized();
        $this->form->setForCreate();
        $this->showModal = true;
    }

    public function openEditModal(int $ocorrenciaId): void
    {
        $this->ensureUserIsAuthorized();
        $this->form->setFromOcorrencia(Ocorrencia::findOrFail($ocorrenciaId));
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->ensureUserIsAuthorized();
        $this->form->validate();

        if ($this->form->editingId) {
            Ocorrencia::findOrFail($this->form->editingId)->update($this->form->toData());
        } else {
            $ocorrencia = Ocorrencia::create($this->form->toData());

            if ($ocorrencia->colaborador_id) {
                $ocorrencia->load('colaborador.user');
                Mail::to($ocorrencia->colaborador->user->email)
                    ->send(new OcorrenciaCriada($ocorrencia));
                $ocorrencia->update(['email_enviado' => now()]);
            }
        }

        $this->swalToastSuccess([
            'title' => 'Salvo com sucesso!',
            'showConfirmButton' => false,
            'position' => 'top-end',
            'timer' => 2000,
        ]);

        $this->closeModal();
    }

    public function confirmDelete(int $ocorrenciaId): void
    {
        $this->ensureUserIsAuthorized();
        $this->deletingId = $ocorrenciaId;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $this->ensureUserIsAuthorized();

        if (! $this->deletingId) {
            return;
        }

        Ocorrencia::findOrFail($this->deletingId)->delete();

        $this->swalToastWarning([
            'title' => 'Excluído com sucesso!',
            'showConfirmButton' => false,
            'position' => 'top-end',
            'timer' => 2000,
        ]);

        $this->closeDeleteModal();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->form->reset();
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
        return view('livewire.admin.ocorrencias-list');
    }
}
