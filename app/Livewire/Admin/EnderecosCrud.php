<?php

namespace App\Livewire\Admin;

use App\Enums\TipoEndereco;
use App\Models\Endereco;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EnderecosCrud extends Component
{
    use WithPagination;

    #[Url(as: 'busca')]
    public string $search = '';

    #[Url(as: 'ativo')]
    public string $ativoFilter = '';

    public bool $showModal = false;

    public bool $showDeleteModal = false;

    public ?int $editingId = null;

    public ?int $deletingId = null;

    public string $nome = '';

    public string $tipo = '';

    public string $numero = '';

    public string $horario = '';

    public string $endereco = '';

    public string $cidadeEstado = '';

    public string $fone = '';

    public bool $ativo = true;

    protected function rules(): array
    {
        $rules = [
            'nome' => ['required', 'string', 'max:255'],
            'tipo' => ['required', Rule::enum(TipoEndereco::class)],
            'numero' => ['nullable', 'string', 'max:50'],
            'horario' => ['nullable', 'string', 'max:100'],
            'endereco' => ['nullable', 'string', 'max:500'],
            'cidadeEstado' => ['nullable', 'string', 'max:255'],
            'fone' => ['nullable', 'string', 'max:50'],
            'ativo' => ['boolean'],
        ];

        if ($this->editingId) {
            $rules['nome'][] = Rule::unique('enderecos', 'nome')->ignore($this->editingId);
        } else {
            $rules['nome'][] = Rule::unique('enderecos', 'nome');
        }

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.unique' => 'Este nome já está cadastrado.',
            'tipo.required' => 'O tipo é obrigatório.',
            'tipo.enum' => 'O tipo selecionado é inválido.',
            'numero.max' => 'O número não pode ter mais de 50 caracteres.',
            'horario.max' => 'O horário não pode ter mais de 100 caracteres.',
            'endereco.max' => 'O endereço não pode ter mais de 500 caracteres.',
            'cidadeEstado.max' => 'A cidade/estado não pode ter mais de 255 caracteres.',
            'fone.max' => 'O fone não pode ter mais de 50 caracteres.',
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedAtivoFilter(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function enderecos()
    {
        return Endereco::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nome', 'like', "%{$this->search}%")
                        ->orWhere('endereco', 'like', "%{$this->search}%")
                        ->orWhere('cidade_estado', 'like', "%{$this->search}%");
                });
            })
            ->when($this->ativoFilter !== '', function ($query) {
                $query->where('ativo', $this->ativoFilter === '1');
            })
            ->orderBy('nome')
            ->paginate(10);
    }

    #[Computed]
    public function tipos(): array
    {
        return TipoEndereco::options();
    }

    public function openCreateModal(): void
    {
        $this->ensureUserIsAuthorized();
        $this->resetForm();
        $this->tipo = TipoEndereco::Agencia->value;
        $this->ativo = true;
        $this->showModal = true;
    }

    public function openEditModal(int $enderecoId): void
    {
        $this->ensureUserIsAuthorized();

        $endereco = Endereco::findOrFail($enderecoId);

        $this->editingId = $endereco->id;
        $this->nome = $endereco->nome;
        $this->tipo = $endereco->tipo->value;
        $this->numero = $endereco->numero ?? '';
        $this->horario = $endereco->horario ?? '';
        $this->endereco = $endereco->endereco ?? '';
        $this->cidadeEstado = $endereco->cidade_estado ?? '';
        $this->fone = $endereco->fone ?? '';
        $this->ativo = $endereco->ativo;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->ensureUserIsAuthorized();
        $this->validate();

        $data = [
            'nome' => $this->nome,
            'tipo' => $this->tipo,
            'numero' => $this->numero ?: null,
            'horario' => $this->horario ?: null,
            'endereco' => $this->endereco ?: null,
            'cidade_estado' => $this->cidadeEstado ?: null,
            'fone' => $this->fone ?: null,
            'ativo' => $this->ativo,
        ];

        if ($this->editingId) {
            Endereco::findOrFail($this->editingId)->update($data);
            session()->flash('success', 'Endereço atualizado com sucesso.');
        } else {
            Endereco::create($data);
            session()->flash('success', 'Endereço criado com sucesso.');
        }

        $this->closeModal();
    }

    public function confirmDelete(int $enderecoId): void
    {
        $this->ensureUserIsAuthorized();
        $this->deletingId = $enderecoId;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $this->ensureUserIsAuthorized();

        if (! $this->deletingId) {
            return;
        }

        Endereco::findOrFail($this->deletingId)->delete();
        session()->flash('success', 'Endereço excluído com sucesso.');
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
        $this->tipo = '';
        $this->numero = '';
        $this->horario = '';
        $this->endereco = '';
        $this->cidadeEstado = '';
        $this->fone = '';
        $this->ativo = true;
        $this->editingId = null;
        $this->resetValidation();
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
        return view('livewire.admin.enderecos-crud');
    }
}
