<?php

namespace App\Livewire\Admin;

use App\Enums\PreventivaStatus;
use App\Enums\TipoColaborador;
use App\Livewire\Admin\Forms\PreventivaForm;
use App\Models\Colaborador;
use App\Models\Preventiva;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class PreventivaModal extends Component
{
    use WithSweetAlert;

    public PreventivaForm $form;

    public bool $showModal = false;

    public bool $isDraft = false;

    #[Computed]
    public function statuses(): array
    {
        return PreventivaStatus::options();
    }

    #[Computed]
    public function colaboradores(): array
    {
        return Colaborador::query()
            ->with('user')
            ->orderBy('nome')
            ->get()
            ->mapWithKeys(fn (Colaborador $colaborador) => [
                $colaborador->id => $colaborador->tipo === TipoColaborador::Administrativos
                    ? "{$colaborador->nome_exibicao} (admin)"
                    : $colaborador->nome_exibicao,
            ])
            ->toArray();
    }

    #[Computed]
    public function editingPreventiva(): ?Preventiva
    {
        if (! $this->form->editingId) {
            return null;
        }

        return Preventiva::with('enderecoVinculado')->find($this->form->editingId);
    }

    public function openCreateModal(): void
    {
        $this->ensureUserIsAuthorized();
        $this->form->setForCreate();

        $preventiva = Preventiva::create([
            'status' => PreventivaStatus::Aberto,
            'titulo' => 'Rascunho',
            'abertura' => now()->format('Y-m-d'),
            'agencia' => 'A definir',
        ]);

        $this->form->editingId = $preventiva->id;
        $this->form->titulo = '';
        $this->form->agencia = '';
        $this->isDraft = true;
        $this->showModal = true;
    }

    public function openEditModal(int $preventivaId): void
    {
        $this->ensureUserIsAuthorized();
        $preventiva = Preventiva::findOrFail($preventivaId);
        $this->isDraft = false;
        $this->form->setFromPreventiva($preventiva);
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        if ($this->isDraft && $this->form->editingId) {
            Preventiva::query()->whereKey($this->form->editingId)->delete();
        }

        $this->showModal = false;
        $this->isDraft = false;
        $this->form->reset();
        unset($this->editingPreventiva);
    }

    public function save(): void
    {
        $this->ensureUserIsAuthorized();
        $this->form->validate();

        $data = $this->form->toData();
        $preventiva = Preventiva::findOrFail($this->form->editingId);

        if ($data['status'] === PreventivaStatus::Concluido->value && $preventiva->status !== PreventivaStatus::Concluido) {
            $data['concluido_por'] = auth()->id();
        }

        $preventiva->update($data);
        $this->isDraft = false;

        $this->closeModal();
        $this->dispatch('preventiva-saved');

        $this->swalToastSuccess([
            'title' => 'Salvo com sucesso!',
            'showConfirmButton' => false,
            'position' => 'top-end',
            'timer' => 2000,
        ]);
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
        return view('livewire.admin.preventiva-modal');
    }
}
