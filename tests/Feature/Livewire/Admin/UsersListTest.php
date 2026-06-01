<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\UserRole;
use App\Livewire\Admin\UsersList;
use App\Models\User;
use App\Notifications\SendPasswordResetNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use SweetAlert2\Laravel\Swal;
use Tests\TestCase;

class UsersListTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
    }

    public function test_admin_can_access_usuarios_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.usuarios'));

        $response->assertStatus(200);
        $response->assertSee('Gestão de Usuários');
    }

    public function test_admin_can_create_user_and_dispatch_success_swal(): void
    {
        Notification::fake();

        Livewire::actingAs($this->admin)
            ->test(UsersList::class)
            ->call('openCreateModal')
            ->set('name', 'Novo Prestador')
            ->set('email', 'prestador@example.com')
            ->set('role', UserRole::Prestador->value)
            ->call('save')
            ->assertDispatched(Swal::SESSION_KEY, function (string $event, array $params): bool {
                return $event === Swal::SESSION_KEY
                    && ($params['title'] ?? null) === 'Salvo com sucesso!'
                    && ($params['icon'] ?? null) === 'success'
                    && ($params['toast'] ?? null) === true;
            })
            ->assertHasNoErrors();

        $user = User::query()->where('email', 'prestador@example.com')->first();

        $this->assertNotNull($user);
        $this->assertSame('Novo Prestador', $user->name);
        $this->assertSame(UserRole::Prestador, $user->role);

        Notification::assertSentTo($user, SendPasswordResetNotification::class);
    }

    public function test_admin_cannot_delete_own_account_and_dispatches_error_swal(): void
    {
        Livewire::actingAs($this->admin)
            ->test(UsersList::class)
            ->call('confirmDelete', $this->admin->id)
            ->assertDispatched(Swal::SESSION_KEY, function (string $event, array $params): bool {
                return $event === Swal::SESSION_KEY
                    && ($params['title'] ?? null) === 'Você não tem permissão para excluir este usuário.'
                    && ($params['icon'] ?? null) === 'error'
                    && ($params['toast'] ?? null) === true;
            });

        $this->assertDatabaseHas('users', ['id' => $this->admin->id]);
    }

    public function test_admin_can_delete_user_and_dispatch_success_swal(): void
    {
        $user = User::factory()->prestador()->create();

        Livewire::actingAs($this->admin)
            ->test(UsersList::class)
            ->call('confirmDelete', $user->id)
            ->call('delete')
            ->assertDispatched(Swal::SESSION_KEY, function (string $event, array $params): bool {
                return $event === Swal::SESSION_KEY
                    && ($params['title'] ?? null) === 'Usuário excluído com sucesso.'
                    && ($params['icon'] ?? null) === 'success'
                    && ($params['toast'] ?? null) === true;
            });

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
