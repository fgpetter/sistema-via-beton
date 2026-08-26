<?php

namespace App\Livewire\Admin;

use App\Actions\Ocorrencias\RenderRatPdfFromOcorrencia;
use App\Enums\OcorrenciaStatus;
use App\Enums\PrazoNome;
use App\Enums\TipoColaborador;
use App\Livewire\Admin\Forms\OcorrenciaForm;
use App\Mail\OcorrenciaCriada;
use App\Models\Colaborador;
use App\Models\Disciplina;
use App\Models\Ocorrencia;
use App\Models\Prazo;
use App\Models\ResponsavelEngenharia;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class OcorrenciaModal extends Component
{
    use WithSweetAlert;

    public OcorrenciaForm $form;

    public bool $showModal = false;

    #[Computed]
    public function statuses(): array
    {
        return OcorrenciaStatus::options();
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
    public function prazos(): array
    {
        return Prazo::query()
            ->orderBy('nome')
            ->get()
            ->mapWithKeys(fn (Prazo $prazo) => [
                $prazo->id => PrazoNome::labelFor($prazo->nome),
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
        return Disciplina::query()
            ->disciplinas()
            ->orderBy('disciplina')
            ->pluck('disciplina', 'id')
            ->toArray();
    }

    #[Computed]
    public function subdisciplinasOptions(): array
    {
        return Disciplina::query()
            ->subdisciplinas()
            ->orderBy('disciplina')
            ->pluck('disciplina', 'id')
            ->toArray();
    }

    #[Computed]
    public function editingOcorrencia(): ?Ocorrencia
    {
        if (! $this->form->editingId) {
            return null;
        }

        return Ocorrencia::with('enderecoVinculado')->find($this->form->editingId);
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
        $ocorrencia = Ocorrencia::findOrFail($ocorrenciaId);
        $this->form->setFromOcorrencia($ocorrencia);
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->form->reset();
        unset($this->editingOcorrencia);
    }

    public function save(): void
    {
        $this->ensureUserIsAuthorized();
        $this->form->validate();

        if ($this->form->editingId) {
            $this->persistEditedOcorrencia();
        } else {
            $ocorrencia = Ocorrencia::create($this->form->toData());

            if ($ocorrencia->colaborador_id) {
                $ocorrencia->load('colaborador.user');
                Mail::to($ocorrencia->colaborador->user->email)
                    ->send(new OcorrenciaCriada($ocorrencia));
                $ocorrencia->update(['email_enviado' => now()]);
            }
        }

        $this->closeModal();
        $this->dispatch('ocorrencia-saved');

        $this->swalToastSuccess(SwalToast::successOptions('Salvo com sucesso!'));
    }

    public function gerarNovaRat(): void
    {
        $this->ensureUserIsAuthorized();

        if (! $this->form->editingId) {
            abort(404);
        }

        $ocorrencia = Ocorrencia::findOrFail($this->form->editingId);

        if ($ocorrencia->rat_pdf_path === null) {
            abort(404);
        }

        $this->form->validate();
        $ocorrencia = $this->persistEditedOcorrencia();

        $ocorrencia = $ocorrencia->fresh([
            'prazo',
            'colaborador',
            'enderecoVinculado',
            'responsavelEngenharia',
            'disciplina',
            'subdisciplina1',
            'subdisciplina2',
            'subdisciplina3',
        ]);

        $relativePath = 'ocorrencias/'.$ocorrencia->id.'/rat/RAT-'.$ocorrencia->id.'.pdf';
        $pdfBytes = app(RenderRatPdfFromOcorrencia::class)($ocorrencia);
        Storage::disk('public')->put($relativePath, $pdfBytes);

        if ($ocorrencia->rat_pdf_path !== $relativePath) {
            $ocorrencia->update(['rat_pdf_path' => $relativePath]);
        }

        unset($this->editingOcorrencia);
        $this->dispatch('ocorrencia-saved');

        $url = route('admin.ocorrencias.rat-pdf', $ocorrencia).'?t='.now()->timestamp;
        $this->js('window.open('.json_encode($url).', "_blank")');

        $this->swalToastSuccess(SwalToast::successOptions('Nova RAT gerada com sucesso!'));
    }

    public function concluirRevisao(int $ocorrenciaId): void
    {
        $this->ensureUserIsAuthorized();

        $ocorrencia = Ocorrencia::findOrFail($ocorrenciaId);

        if ($ocorrencia->status !== OcorrenciaStatus::Revisar) {
            abort(403, 'Apenas ocorrências em revisão podem ser concluídas.');
        }

        $ocorrencia->update([
            'status' => OcorrenciaStatus::Concluido,
            'concluido_por' => auth()->id(),
        ]);

        $this->closeModal();
        $this->dispatch('ocorrencia-saved');

        $this->swalToastSuccess(SwalToast::successOptions('Ocorrência concluída!'));
    }

    protected function persistEditedOcorrencia(): Ocorrencia
    {
        $ocorrencia = Ocorrencia::findOrFail($this->form->editingId);
        $data = $this->form->toData($ocorrencia);

        if ($data['status'] === OcorrenciaStatus::Concluido->value && $ocorrencia->status !== OcorrenciaStatus::Concluido) {
            $data['concluido_por'] = auth()->id();
        }
        $data['relatorio_pdf_path'] = null;
        $ocorrencia->update($data);

        return $ocorrencia->fresh();
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
        return view('livewire.admin.ocorrencia-modal');
    }
}
