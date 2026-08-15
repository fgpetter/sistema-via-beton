<?php

namespace App\Livewire\Admin;

use App\Models\ResponsavelEngenharia;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class ResponsaveisEngenhariaCrud extends Component
{
    use WithPagination;
    use WithSweetAlert;

    #[Url(as: 'busca_responsavel')]
    public string $search = '';

    public bool $showModal = false;

    public bool $showDeleteModal = false;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $nome = '';

    protected function rules(): array
    {
        $rules = [
            'nome' => ['required', 'string', 'max:255'],
        ];

        if ($this->editingId) {
            $rules['nome'][] = Rule::unique('responsavel_engenharia', 'nome')->ignore($this->editingId);
        } else {
            $rules['nome'][] = Rule::unique('responsavel_engenharia', 'nome');
        }

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.unique' => 'Este nome já está cadastrado. Se estiver inativo, restaure o registro existente.',
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage('responsaveisPage');
    }

    #[Computed]
    public function responsaveisList()
    {
        return ResponsavelEngenharia::query()
            ->withTrashed()
            ->when($this->search, function ($query) {
                $query->where('nome', 'like', "%{$this->search}%");
            })
            ->orderBy('nome')
            ->paginate(10, pageName: 'responsaveisPage');
    }

    public function openCreateModal(): void
    {
        $this->ensureUserIsAuthorized();
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal(int $responsavelId): void
    {
        $this->ensureUserIsAuthorized();

        $item = ResponsavelEngenharia::withTrashed()->findOrFail($responsavelId);

        $this->editingId = $item->id;
        $this->nome = $item->nome;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->ensureUserIsAuthorized();
        $this->validate();

        $data = [
            'nome' => $this->nome,
        ];

        if ($this->editingId) {
            ResponsavelEngenharia::withTrashed()->findOrFail($this->editingId)->update($data);
            $this->swalToastSuccess(SwalToast::successOptions('Responsável Engenharia Banrisul atualizado com sucesso.'));
        } else {
            ResponsavelEngenharia::create($data);
            $this->swalToastSuccess(SwalToast::successOptions('Responsável Engenharia Banrisul criado com sucesso.'));
        }

        $this->closeModal();
    }

    public function confirmDelete(int $responsavelId): void
    {
        $this->ensureUserIsAuthorized();
        $this->deletingId = $responsavelId;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $this->ensureUserIsAuthorized();

        if (! $this->deletingId) {
            return;
        }

        $item = ResponsavelEngenharia::withTrashed()->findOrFail($this->deletingId);

        if ($item->trashed()) {
            $this->closeDeleteModal();

            return;
        }

        $item->delete();
        $this->swalToastSuccess(SwalToast::successOptions('Responsável Engenharia Banrisul inativado com sucesso.'));
        $this->closeDeleteModal();
    }

    public function restore(int $responsavelId): void
    {
        $this->ensureUserIsAuthorized();

        ResponsavelEngenharia::onlyTrashed()->findOrFail($responsavelId)->restore();
        $this->swalToastSuccess(SwalToast::successOptions('Responsável Engenharia Banrisul restaurado com sucesso.'));
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
        $this->deletingId = null;
    }

    protected function resetForm(): void
    {
        $this->nome = '';
        $this->editingId = null;
        $this->resetValidation();
    }

    protected function ensureUserIsAuthorized(): void
    {
        /** @var User|null $user */
        $user = auth()->guard()->user();
        if (! $user?->isAdmin()) {
            abort(403, 'Você não tem permissão para acessar esta funcionalidade.');
        }
    }

    public function render(): View
    {
        return view('livewire.admin.responsaveis-engenharia-crud');
    }
}
