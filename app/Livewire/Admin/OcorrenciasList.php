<?php

namespace App\Livewire\Admin;

use App\Enums\OcorrenciaStatus;
use App\Imports\OcorrenciasImport;
use App\Models\Ocorrencia;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
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

    /**
     * Valor sintético do filtro de status na URL somente para esse filtro sem afetar OcorrenciaStatus enum.
     */
    public const STATUS_FILTER_ABERTO_ANDAMENTO = 'aberto_andamento';

    #[Url(as: 'busca')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $statusFilter = self::STATUS_FILTER_ABERTO_ANDAMENTO;

    #[Url(as: 'prioridade')]
    public string $priorityFilter = '';

    public bool $showDeleteModal = false;

    public ?int $deletingId = null;

    public $importFile;

    /**
     * Valores exibidos nos inputs de ordenação por ID de ocorrência (chave string).
     *
     * @var array<string, int|string|null>
     */
    public array $ordemPrestadorInputs = [];

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

    public function updatedPriorityFilter(): void
    {
        $this->resetPage();
    }

    public function rendering(): void
    {
        foreach ($this->ocorrencias as $ocorrencia) {
            if ($ocorrencia->isEmergencial()) {
                continue;
            }
            $id = (string) $ocorrencia->id;
            if (! array_key_exists($id, $this->ordemPrestadorInputs)) {
                $this->ordemPrestadorInputs[$id] = $ocorrencia->ordem_prestador;
            }
        }
    }

    public function updatedOrdemPrestadorInputs(mixed $value, ?string $key): void
    {
        if ($key === null) {
            return;
        }

        $this->ensureUserIsAuthorized();

        $ocorrenciaId = (int) $key;

        $ocorrencia = Ocorrencia::query()->whereKey($ocorrenciaId)->with('prazo')->first();
        if (! $ocorrencia) {
            $this->addError('ordemPrestadorInputs.'.$key, 'Ocorrência não encontrada.');

            return;
        }

        if ($ocorrencia->isEmergencial()) {
            $this->resetErrorBag('ordemPrestadorInputs.'.$key);
            $this->ordemPrestadorInputs[$key] = $ocorrencia->ordem_prestador;

            return;
        }

        $raw = $value;
        if ($raw === '' || $raw === null) {
            $normalized = null;
        } else {
            $validator = Validator::make(
                ['ordem' => $raw],
                [
                    'ordem' => ['regex:/^\d{1,2}$/', 'integer', 'min:0', 'max:99'],
                ],
                [
                    'ordem.regex' => 'Informe no máximo 2 dígitos (0 a 99).',
                    'ordem.integer' => 'Informe um número inteiro entre 0 e 99.',
                    'ordem.min' => 'O valor deve estar entre 0 e 99.',
                    'ordem.max' => 'O valor deve estar entre 0 e 99.',
                ]
            );

            if ($validator->fails()) {
                $this->addError('ordemPrestadorInputs.'.$key, (string) $validator->errors()->first('ordem'));
                $this->ordemPrestadorInputs[$key] = Ocorrencia::query()->whereKey($ocorrenciaId)->value('ordem_prestador');

                return;
            }

            $normalized = (int) $raw;
        }

        $ocorrencia->update(['ordem_prestador' => $normalized]);

        $this->resetErrorBag('ordemPrestadorInputs.'.$key);
        $this->ordemPrestadorInputs[$key] = $normalized;
        unset($this->ocorrencias);
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
                if ($this->statusFilter === self::STATUS_FILTER_ABERTO_ANDAMENTO) {
                    $query->whereIn('status', [
                        OcorrenciaStatus::Aberto,
                        OcorrenciaStatus::Andamento,
                    ]);

                    return;
                }

                $status = OcorrenciaStatus::tryFrom($this->statusFilter);
                if ($status) {
                    $query->status($status);
                }
            })
            ->when($this->priorityFilter, function ($query) {
                $query->where('prioridade', $this->priorityFilter);
            })
            ->emergenciaisFirst()
            ->orderByDesc('abertura')
            ->paginate(10);
    }

    #[Computed]
    public function statuses(): array
    {
        return array_merge(
            [self::STATUS_FILTER_ABERTO_ANDAMENTO => 'Aberto/Andamento'],
            OcorrenciaStatus::options(),
        );
    }

    #[Computed]
    public function priorities(): array
    {
        return Ocorrencia::query()
            ->whereNotNull('prioridade')
            ->where('prioridade', '!=', '')
            ->orderBy('prioridade')
            ->distinct()
            ->pluck('prioridade', 'prioridade')
            ->toArray();
    }

    #[On('ocorrencia-saved')]
    public function handleOcorrenciaSaved(): void
    {
        $this->resetPage();
        unset($this->ocorrencias);
        $this->ordemPrestadorInputs = [];
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

        $deletedId = $this->deletingId;

        Ocorrencia::findOrFail($deletedId)->delete();

        unset($this->ordemPrestadorInputs[(string) $deletedId], $this->ocorrencias);
        $this->swalToastSuccess(SwalToast::successOptions('Excluído com sucesso!'));

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

        $this->swalToastSuccess(SwalToast::successOptions(
            "{$imported} ocorrência(s) importada(s)!",
            $skipped > 0 ? "{$skipped} ocorrência(s) ignorada(s) por IDs duplicados." : null,
            4000
        ));
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
