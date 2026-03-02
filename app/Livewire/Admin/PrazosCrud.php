<?php

namespace App\Livewire\Admin;

use App\Enums\PrazoUnidade;
use App\Models\Prazo;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PrazosCrud extends Component
{
    use WithPagination;

    #[Url(as: 'busca')]
    public string $search = '';

    public bool $showModal = false;

    public bool $showDeleteModal = false;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $nome = '';

    public int|string $prazoValor = '';

    public string $prazoUnidade = '';

    protected function rules(): array
    {
        $rules = [
            'nome' => ['required', 'string', 'max:255'],
            'prazoValor' => ['required', 'integer', 'min:1'],
            'prazoUnidade' => ['required', Rule::enum(PrazoUnidade::class)],
        ];

        if ($this->editingId) {
            $rules['nome'][] = Rule::unique('prazos', 'nome')->ignore($this->editingId);
        } else {
            $rules['nome'][] = Rule::unique('prazos', 'nome');
        }

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.unique' => 'Este nome já está cadastrado.',
            'prazoValor.required' => 'O prazo é obrigatório.',
            'prazoValor.integer' => 'O prazo deve ser um número inteiro.',
            'prazoValor.min' => 'O prazo deve ser maior que zero.',
            'prazoUnidade.required' => 'A unidade é obrigatória.',
            'prazoUnidade.enum' => 'A unidade selecionada é inválida.',
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function prazos()
    {
        return Prazo::query()
            ->when($this->search, function ($query) {
                $query->where('nome', 'like', "%{$this->search}%");
            })
            ->orderBy('nome')
            ->paginate(10);
    }

    #[Computed]
    public function unidades(): array
    {
        return PrazoUnidade::options();
    }

    public function openCreateModal(): void
    {
        $this->ensureUserIsAuthorized();
        $this->resetForm();
        $this->prazoUnidade = PrazoUnidade::Dia->value;
        $this->showModal = true;
    }

    public function openEditModal(int $prazoId): void
    {
        $this->ensureUserIsAuthorized();

        $prazo = Prazo::findOrFail($prazoId);

        $this->editingId = $prazo->id;
        $this->nome = $prazo->nome;
        $this->prazoValor = $prazo->prazo_valor;
        $this->prazoUnidade = $prazo->prazo_unidade->value;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->ensureUserIsAuthorized();
        $this->validate();

        $data = [
            'nome' => $this->nome,
            'prazo_valor' => (int) $this->prazoValor,
            'prazo_unidade' => $this->prazoUnidade,
        ];

        if ($this->editingId) {
            Prazo::findOrFail($this->editingId)->update($data);
            session()->flash('success', 'Prazo atualizado com sucesso.');
        } else {
            Prazo::create($data);
            session()->flash('success', 'Prazo criado com sucesso.');
        }

        $this->closeModal();
    }

    public function confirmDelete(int $prazoId): void
    {
        $this->ensureUserIsAuthorized();
        $this->deletingId = $prazoId;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $this->ensureUserIsAuthorized();

        if (! $this->deletingId) {
            return;
        }

        Prazo::findOrFail($this->deletingId)->delete();
        session()->flash('success', 'Prazo excluído com sucesso.');
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
        $this->nome = '';
        $this->prazoValor = '';
        $this->prazoUnidade = '';
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
        return view('livewire.admin.prazos-crud');
    }
}
