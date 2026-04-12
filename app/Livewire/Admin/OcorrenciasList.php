<?php

namespace App\Livewire\Admin;

use App\Enums\OcorrenciaStatus;
use App\Enums\PrazoNome;
use App\Enums\TipoColaborador;
use App\Imports\OcorrenciasImport;
use App\Livewire\Admin\Forms\OcorrenciaForm;
use App\Mail\OcorrenciaCriada;
use App\Models\Colaborador;
use App\Models\Ocorrencia;
use App\Models\Prazo;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

#[Layout('layouts.vertical')]
#[Title('Gestão de Ocorrências')]
class OcorrenciasList extends Component
{
    use WithFileUploads;
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

    public $importFile;

    public function updatedImportFile(): void
    {
        if ($this->importFile) {
            $this->importOcorrencias();
        }
    }

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
            ->with(['colaborador.user', 'prazo', 'concluidoPor', 'enderecoVinculado'])
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
            ->when($this->statusFilter, function ($query) {
                $status = OcorrenciaStatus::tryFrom($this->statusFilter);
                if ($status) {
                    $query->status($status);
                }
            })
            ->emergenciaisFirst()
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

    public function save(): void
    {
        $this->ensureUserIsAuthorized();
        $this->form->validate();

        if ($this->form->editingId) {
            $data = $this->form->toData();
            $ocorrencia = Ocorrencia::findOrFail($this->form->editingId);

            if ($data['status'] === OcorrenciaStatus::Concluido->value && $ocorrencia->status !== OcorrenciaStatus::Concluido) {
                $data['concluido_por'] = auth()->id();
            }

            $ocorrencia->update($data);
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

        $this->swalToastSuccess([
            'title' => 'Salvo com sucesso!',
            'showConfirmButton' => false,
            'position' => 'top-end',
            'timer' => 2000,
        ]);
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

        $this->swalToastSuccess([
            'title' => 'Ocorrência concluída!',
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

    public function importOcorrencias(): void
    {
        $this->ensureUserIsAuthorized();

        $this->validate([
            'importFile' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:10240'],
        ], [
            'importFile.required' => 'Selecione um arquivo para importar.',
            'importFile.mimes' => 'O arquivo deve ser do tipo: xlsx, xls ou csv.',
            'importFile.max' => 'O arquivo não pode ser maior que 10MB.',
        ]);

        $import = new OcorrenciasImport;

        Excel::import($import, $this->importFile->getRealPath());

        $this->reset('importFile');
        unset($this->ocorrencias);

        $imported = $import->getImportedCount();
        $skipped = $import->getSkippedCount();

        $this->swalToastSuccess([
            'title' => "{$imported} ocorrência(s) importada(s)!",
            'text' => $skipped > 0 ? "{$skipped} linha(s) ignorada(s) por campos obrigatórios em branco." : '',
            'showConfirmButton' => false,
            'position' => 'top-end',
            'timer' => 4000,
        ]);
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->form->reset();
        unset($this->editingOcorrencia);
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
