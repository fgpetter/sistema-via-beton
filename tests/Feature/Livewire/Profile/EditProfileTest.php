<?php

namespace Tests\Feature\Livewire\Profile;

use App\Livewire\Profile\EditProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use SweetAlert2\Laravel\Swal;
use Tests\TestCase;

class EditProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_profile_and_see_success_toast(): void
    {
        $user = User::factory()->prestador()->create([
            'name' => 'Nome Antigo',
            'email' => 'antigo@example.com',
        ]);

        Livewire::actingAs($user)
            ->test(EditProfile::class)
            ->set('name', 'Nome Atualizado')
            ->set('email', 'novo@example.com')
            ->call('save')
            ->assertDispatched(Swal::SESSION_KEY, function (string $event, array $params): bool {
                return $event === Swal::SESSION_KEY
                    && ($params['title'] ?? null) === 'Perfil atualizado com sucesso.'
                    && ($params['icon'] ?? null) === 'success'
                    && ($params['toast'] ?? null) === true;
            })
            ->assertHasNoErrors();

        $user->refresh();

        $this->assertSame('Nome Atualizado', $user->name);
        $this->assertSame('novo@example.com', $user->email);
    }
}
