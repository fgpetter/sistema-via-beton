<?php

namespace App\Livewire\Admin;

use App\Actions\Programadas\RenderRatPdfFromProgramada;
use App\Enums\ProgramadaStatus;
use App\Enums\ProgramadaTipo;
use App\Enums\TipoColaborador;
use App\Livewire\Admin\Forms\ProgramadaForm;
use App\Mail\ProgramadaCriada;
use App\Models\Colaborador;
use App\Models\Disciplina;
use App\Models\Programada;
use App\Models\ResponsavelEngenharia;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
    public function disciplinasOptions(): array
    {
        return Disciplina::query()->disciplinas()->orderBy('disciplina')->pluck('disciplina', 'id')->toArray();
    }

    #[Computed]
    public function subdisciplinasOptions(): array
    {
        return Disciplina::query()->subdisciplinas()->orderBy('disciplina')->pluck('disciplina', 'id')->toArray();
    }

    #[Computed]
    public function editingProgramada(): ?Programada
    {
        if (! $this->form->editingId) {
            return null;
        }

        return Programada::with(['enderecoVinculado', 'colaborador'])->find($this->form->editingId);
    }

    public function openCreateModal(): void
    {
        $this->ensureUserIsAuthorized();
        $this->form->setForCreate();

        $programada = Programada::create([
            'status' => ProgramadaStatus::Aberto,
            'tipo' => ProgramadaTipo::Corretiva,
            'titulo' => 'Rascunho',
            'abertura' => now()->format('Y-m-d'),
            'agencia' => 'A definir',
        ]);

        $this->form->editingId = $programada->id;
        $this->form->tipo = ProgramadaTipo::Corretiva->value;
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

        $programada = Programada::findOrFail($this->form->editingId);
        $eraRascunho = $this->isDraft;
        $data = $this->form->toData($programada);

        if ($data['status'] === ProgramadaStatus::Concluido->value && $programada->status !== ProgramadaStatus::Concluido) {
            $data['concluido_por'] = auth()->id();
        }

        $programada->update($data);
        if ($eraRascunho && $programada->colaborador_id) {
            $programada->load('colaborador.user');
            if ($programada->colaborador?->user?->email) {
                Mail::to($programada->colaborador->user->email)->send(new ProgramadaCriada($programada));
            }
        }
        $this->isDraft = false;

        $this->closeModal();
        $this->dispatch('programada-saved');

        $this->swalToastSuccess(SwalToast::successOptions('Salvo com sucesso!'));
    }

    public function gerarNovaRat(): void
    {
        $this->ensureUserIsAuthorized();
        $programada = Programada::findOrFail($this->form->editingId);
        abort_if($programada->rat_pdf_path === null, 404);
        $this->form->validate();
        $data = $this->form->toData($programada);
        if ($data['status'] === ProgramadaStatus::Concluido->value && $programada->status !== ProgramadaStatus::Concluido) {
            $data['concluido_por'] = auth()->id();
        }
        $programada->update($data);
        $programada = $programada->fresh();
        $path = "programadas/{$programada->id}/rat/RAT-{$programada->id}.pdf";
        Storage::disk('public')->put($path, app(RenderRatPdfFromProgramada::class)($programada));
        $programada->update(['rat_pdf_path' => $path]);
        $this->dispatch('programada-saved');
        $this->js('window.open('.json_encode(route('admin.programadas.rat-pdf', $programada).'?t='.now()->timestamp).', "_blank")');
        $this->swalToastSuccess(SwalToast::successOptions('Nova RAT gerada com sucesso!'));
    }

    public function concluirRevisao(int $programadaId): void
    {
        $this->ensureUserIsAuthorized();
        $programada = Programada::findOrFail($programadaId);
        abort_unless($programada->status === ProgramadaStatus::Revisar, 403);
        $programada->update(['status' => ProgramadaStatus::Concluido, 'concluido_por' => auth()->id()]);
        $this->closeModal();
        $this->dispatch('programada-saved');
        $this->swalToastSuccess(SwalToast::successOptions('Programada concluída!'));
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
