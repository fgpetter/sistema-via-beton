<?php

namespace App\Livewire\Admin;

use App\Models\Disciplina;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class DisciplinasCrud extends Component
{
    use WithPagination;
    use WithSweetAlert;

    #[Url(as: 'busca')]
    public string $search = '';

    public bool $showModal = false;

    public bool $showDeleteModal = false;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $disciplina = '';

    public bool $subdisciplina = false;

    protected function rules(): array
    {
        $rules = [
            'disciplina' => ['required', 'string', 'max:255'],
            'subdisciplina' => ['boolean'],
        ];

        if ($this->editingId) {
            $rules['disciplina'][] = Rule::unique('disciplinas', 'disciplina')->ignore($this->editingId);
        } else {
            $rules['disciplina'][] = Rule::unique('disciplinas', 'disciplina');
        }

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'disciplina.required' => 'O nome é obrigatório.',
            'disciplina.unique' => 'Este nome já está cadastrado.',
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function disciplinasList()
    {
        return Disciplina::query()
            ->when($this->search, function ($query) {
                $query->where('disciplina', 'like', "%{$this->search}%");
            })
            ->orderBy('disciplina')
            ->paginate(10);
    }

    public function openCreateModal(): void
    {
        $this->ensureUserIsAuthorized();
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal(int $disciplinaId): void
    {
        $this->ensureUserIsAuthorized();

        $item = Disciplina::findOrFail($disciplinaId);

        $this->editingId = $item->id;
        $this->disciplina = $item->disciplina;
        $this->subdisciplina = $item->subdisciplina;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->ensureUserIsAuthorized();
        $this->validate();

        $data = [
            'disciplina' => $this->disciplina,
            'subdisciplina' => $this->subdisciplina,
        ];

        if ($this->editingId) {
            Disciplina::findOrFail($this->editingId)->update($data);
            $this->swalToastSuccess(SwalToast::successOptions('Disciplina atualizada com sucesso.'));
        } else {
            Disciplina::create($data);
            $this->swalToastSuccess(SwalToast::successOptions('Disciplina criada com sucesso.'));
        }

        $this->closeModal();
    }

    public function confirmDelete(int $disciplinaId): void
    {
        $this->ensureUserIsAuthorized();
        $this->deletingId = $disciplinaId;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $this->ensureUserIsAuthorized();

        if (! $this->deletingId) {
            return;
        }

        Disciplina::findOrFail($this->deletingId)->delete();
        $this->swalToastSuccess(SwalToast::successOptions('Disciplina excluída com sucesso.'));
        $this->closeDeleteModal();
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
        $this->disciplina = '';
        $this->subdisciplina = false;
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
        return view('livewire.admin.disciplinas-crud');
    }
}
