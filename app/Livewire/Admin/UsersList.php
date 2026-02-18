<?php

namespace App\Livewire\Admin;

use App\Enums\UserRole;
use App\Models\User;
use App\Notifications\SendPasswordResetNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;

    #[Url(as: 'busca')]
    public string $search = '';

    #[Url(as: 'perfil')]
    public string $roleFilter = '';

    public bool $showModal = false;

    public ?int $editingUserId = null;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $role = '';

    public bool $showDeleteModal = false;

    public ?int $deletingUserId = null;

    protected function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required', Rule::enum(UserRole::class)],
        ];

        if ($this->editingUserId) {
            $rules['email'][] = Rule::unique('users', 'email')->ignore($this->editingUserId);
            $rules['password'] = ['nullable', 'string', Password::defaults()];
        } else {
            $rules['email'][] = Rule::unique('users', 'email');
        }

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'role.required' => 'O perfil é obrigatório.',
            'role.enum' => 'O perfil selecionado é inválido.',
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedRoleFilter(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function users()
    {
        return User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                });
            })
            ->when($this->roleFilter, function ($query) {
                $role = UserRole::tryFrom($this->roleFilter);
                if ($role) {
                    $query->role($role);
                }
            })
            ->orderBy('name')
            ->paginate(10);
    }

    #[Computed]
    public function roles(): array
    {
        return UserRole::options();
    }

    public function openCreateModal(): void
    {
        $this->ensureUserIsAuthorized();
        $this->resetForm();
        $this->editingUserId = null;
        $this->role = UserRole::Prestador->value;
        $this->showModal = true;
    }

    public function openEditModal(int $userId): void
    {
        $this->ensureUserIsAuthorized();

        $user = User::findOrFail($userId);

        if (! $this->canEditUser($user)) {
            session()->flash('error', 'Você não tem permissão para editar este usuário.');

            return;
        }

        $this->editingUserId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role->value;
        $this->password = '';
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->ensureUserIsAuthorized();
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if ($this->editingUserId) {
            $user = User::findOrFail($this->editingUserId);

            if (! $this->canEditUser($user)) {
                session()->flash('error', 'Você não tem permissão para editar este usuário.');

                return;
            }

            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }

            $user->update($data);
            session()->flash('success', 'Usuário atualizado com sucesso.');
        } else {
            $temporaryPassword = Str::random(32);
            $data['password'] = Hash::make($temporaryPassword);
            $user = User::create($data);
            $user->notify(new SendPasswordResetNotification);
            session()->flash('success', 'Usuário criado com sucesso. Um email foi enviado para o usuário definir sua senha.');
        }

        $this->closeModal();
    }

    public function confirmDelete(int $userId): void
    {
        $this->ensureUserIsAuthorized();

        $user = User::findOrFail($userId);

        if (! $this->canDeleteUser($user)) {
            session()->flash('error', 'Você não tem permissão para excluir este usuário.');

            return;
        }

        $this->deletingUserId = $userId;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $this->ensureUserIsAuthorized();

        if (! $this->deletingUserId) {
            return;
        }

        $user = User::findOrFail($this->deletingUserId);

        if (! $this->canDeleteUser($user)) {
            session()->flash('error', 'Você não tem permissão para excluir este usuário.');
            $this->closeDeleteModal();

            return;
        }

        /** @var User $currentUser */
        $currentUser = auth()->user();
        if ($user->id === $currentUser->id) {
            session()->flash('error', 'Você não pode excluir sua própria conta.');
            $this->closeDeleteModal();

            return;
        }

        $user->delete();
        session()->flash('success', 'Usuário excluído com sucesso.');
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
        $this->deletingUserId = null;
    }

    protected function resetForm(): void
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = '';
        $this->editingUserId = null;
        $this->resetValidation();
    }

    protected function ensureUserIsAuthorized(): void
    {
        if (! auth()->user()?->isAdmin()) {
            abort(403, 'Você não tem permissão para acessar esta funcionalidade.');
        }
    }

    protected function canEditUser(User $user): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    protected function canDeleteUser(User $user): bool
    {
        /** @var User $currentUser */
        $currentUser = auth()->user();

        if ($user->id === $currentUser->id) {
            return false;
        }

        return $currentUser->isAdmin();
    }

    public function render(): View
    {
        return view('livewire.admin.users-list');
    }
}
