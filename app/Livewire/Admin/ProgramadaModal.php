<?php

namespace App\Livewire\Admin;

use App\Enums\ProgramadaStatus;
use App\Enums\ProgramadaTipo;
use App\Enums\TipoColaborador;
use App\Livewire\Admin\Forms\ProgramadaForm;
use App\Models\Colaborador;
use App\Models\Programada;
use App\Models\ResponsavelEngenharia;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class ProgramadaModal extends Component
{
    use WithSweetAlert;

    public ProgramadaForm $form;

    public bool $showModal = false;

    public bool $isDraft = false;

    #[Computed]
    public function tipos(): array
    {
        return ProgramadaTipo::options();
    }

    #[Computed]
    public function statuses(): array
    {
        return ProgramadaStatus::options();
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
    public function responsaveisEngenhariaBanrisul(): array
    {
        return ResponsavelEngenharia::optionsForSelect($this->form->responsavelEngenhariaId);
    }

    #[Computed]
    public function editingProgramada(): ?Programada
    {
        if (! $this->form->editingId) {
            return null;
        }

        return Programada::with('enderecoVinculado')->find($this->form->editingId);
    }

    public function openCreateModal(): void
    {
        $this->ensureUserIsAuthorized();
        $this->form->setForCreate();

        $programada = Programada::create([
            'status' => ProgramadaStatus::Aberto,
            'titulo' => 'Rascunho',
            'abertura' => now()->format('Y-m-d'),
            'agencia' => 'A definir',
        ]);

        $this->form->editingId = $programada->id;
        $this->form->titulo = '';
        $this->form->agencia = '';
        $this->isDraft = true;
        $this->showModal = true;
    }

    public function openEditModal(int $programadaId): void
    {
        $this->ensureUserIsAuthorized();
        $programada = Programada::findOrFail($programadaId);
        $this->isDraft = false;
        $this->form->setFromProgramada($programada);
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        if ($this->isDraft && $this->form->editingId) {
            Programada::query()->whereKey($this->form->editingId)->delete();
        }

        $this->showModal = false;
        $this->isDraft = false;
        $this->form->reset();
        unset($this->editingProgramada);
    }

    public function save(): void
    {
        $this->ensureUserIsAuthorized();
        $this->form->validate();

        $data = $this->form->toData();
        $programada = Programada::findOrFail($this->form->editingId);

        if ($data['status'] === ProgramadaStatus::Concluido->value && $programada->status !== ProgramadaStatus::Concluido) {
            $data['concluido_por'] = auth()->id();
        }

        $programada->update($data);
        $this->isDraft = false;

        $this->closeModal();
        $this->dispatch('programada-saved');

        $this->swalToastSuccess(SwalToast::successOptions('Salvo com sucesso!'));
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
        return view('livewire.admin.programada-modal');
    }
}
