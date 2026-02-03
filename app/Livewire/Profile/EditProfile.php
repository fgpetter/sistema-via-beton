<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class EditProfile extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function mount(): void
    {
        $user = auth()->user();
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    protected function rules(): array
    {
        $user = auth()->user();
        $userId = $user?->id ?? 0;

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$userId],
        ];

        if ($this->password) {
            $rules['password'] = ['required', 'string', 'confirmed', Password::defaults()];
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
            'password.confirmed' => 'A confirmação da senha não confere.',
        ];
    }

    public function save(): void
    {
        $this->validate();

        $user = auth()->user();
        if (! $user) {
            return;
        }

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        session()->flash('success', 'Perfil atualizado com sucesso.');
    }

    public function render(): View
    {
        return view('livewire.profile.edit-profile');
    }
}
