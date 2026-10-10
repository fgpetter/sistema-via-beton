<?php

namespace App\Livewire\Admin;

use App\Enums\ChecklistResposta;
use App\Enums\TipoChecklist;
use App\Livewire\Admin\Forms\OcorrenciaChecklistForm;
use App\Models\Ocorrencia;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class OcorrenciaChecklistModal extends Component
{
    use WithSweetAlert;

    public OcorrenciaChecklistForm $form;

    public bool $showModal = false;

    #[Computed]
    public function ocorrencia(): ?Ocorrencia
    {
        if (! $this->form->ocorrenciaId) {
            return null;
        }

        return Ocorrencia::with($this->form->tipo->relacao())->find($this->form->ocorrenciaId);
    }

    public function openChecklistModal(int $ocorrenciaId, string $tipo): void
    {
        $this->ensureUserIsAuthorized();

        $tipoChecklist = TipoChecklist::tryFrom($tipo);

        if ($tipoChecklist === null) {
            abort(404);
        }

        $ocorrencia = Ocorrencia::with($tipoChecklist->relacao())->findOrFail($ocorrenciaId);
        $this->form->setFromOcorrencia($ocorrencia, $tipoChecklist);
        unset($this->ocorrencia);
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->form->reset();
        unset($this->ocorrencia);
    }

    public function marcarBloco(string $bloco, string $resposta): void
    {
        $this->ensureUserIsAuthorized();

        $respostaEnum = ChecklistResposta::tryFrom($resposta);

        if ($respostaEnum === null) {
            abort(404);
        }

        $this->form->marcarBloco($this->form->tipo->bloco($bloco), $respostaEnum);
    }

    public function save(): void
    {
        $this->ensureUserIsAuthorized();
        $this->form->validate();

        $ocorrenciaId = $this->form->ocorrenciaId;
        $tipo = $this->form->tipo;
        $modelo = $tipo->modelo();

        $modelo::updateOrCreate(
            ['ocorrencia_id' => $ocorrenciaId],
            $this->form->toData(),
        );

        $this->closeModal();
        $this->dispatch('ocorrencia-saved');

        $this->swalToastSuccess(SwalToast::successOptions('Checklist '.$tipo->label().' salvo com sucesso!'));

        $this->js('window.open('.json_encode(route('admin.ocorrencias.checklist-pdf', [$ocorrenciaId, $tipo->value])).', "_blank")');
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
        return view('livewire.admin.ocorrencia-checklist-modal');
    }
}
