<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\ResponsaveisEngenhariaCrud;
use App\Models\ResponsavelEngenharia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use SweetAlert2\Laravel\Swal;
use Tests\TestCase;

class ResponsaveisEngenhariaCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private User $prestador;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        $this->prestador = User::factory()->prestador()->create();
    }

    public function test_admin_can_see_responsaveis_on_configuracoes_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.configuracoes-sistema'));

        $response->assertSuccessful();
        $response->assertSee('Responsáveis Engenharia Banrisul');
        $response->assertSee('Dustin Hofman');
        $response->assertSee('Icaro Dupont');
        $response->assertSee('Dustin Hofman / Icaro Dupont');
    }

    public function test_admin_can_create_responsavel(): void
    {
        Livewire::actingAs($this->admin)
            ->test(ResponsaveisEngenhariaCrud::class)
            ->call('openCreateModal')
            ->set('nome', 'Novo Engenheiro')
            ->call('save')
            ->assertDispatched(Swal::SESSION_KEY, fn (string $event, array $params): bool => $event === Swal::SESSION_KEY
                && ($params['title'] ?? null) === 'Responsável Engenharia Banrisul criado com sucesso.'
                && ($params['icon'] ?? null) === 'success'
                && ($params['toast'] ?? null) === true)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('responsavel_engenharia', [
            'nome' => 'Novo Engenheiro',
            'deleted_at' => null,
        ]);
    }

    public function test_admin_can_update_responsavel(): void
    {
        $item = ResponsavelEngenharia::factory()->create(['nome' => 'Antigo']);

        Livewire::actingAs($this->admin)
            ->test(ResponsaveisEngenhariaCrud::class)
            ->call('openEditModal', $item->id)
            ->set('nome', 'Novo Nome')
            ->call('save')
            ->assertDispatched(Swal::SESSION_KEY, fn (string $event, array $params): bool => $event === Swal::SESSION_KEY
                && ($params['title'] ?? null) === 'Responsável Engenharia Banrisul atualizado com sucesso.'
                && ($params['icon'] ?? null) === 'success'
                && ($params['toast'] ?? null) === true)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('responsavel_engenharia', [
            'id' => $item->id,
            'nome' => 'Novo Nome',
        ]);
    }

    public function test_admin_can_inactivate_responsavel(): void
    {
        $item = ResponsavelEngenharia::factory()->create(['nome' => 'Para Inativar']);

        Livewire::actingAs($this->admin)
            ->test(ResponsaveisEngenhariaCrud::class)
            ->call('confirmDelete', $item->id)
            ->call('delete')
            ->assertDispatched(Swal::SESSION_KEY, fn (string $event, array $params): bool => $event === Swal::SESSION_KEY
                && ($params['title'] ?? null) === 'Responsável Engenharia Banrisul inativado com sucesso.'
                && ($params['icon'] ?? null) === 'success'
                && ($params['toast'] ?? null) === true)
            ->assertSee('Inativo');

        $this->assertSoftDeleted($item);
    }

    public function test_admin_can_restore_responsavel(): void
    {
        $item = ResponsavelEngenharia::factory()->create(['nome' => 'Para Restaurar']);
        $item->delete();

        Livewire::actingAs($this->admin)
            ->test(ResponsaveisEngenhariaCrud::class)
            ->call('restore', $item->id)
            ->assertDispatched(Swal::SESSION_KEY, fn (string $event, array $params): bool => $event === Swal::SESSION_KEY
                && ($params['title'] ?? null) === 'Responsável Engenharia Banrisul restaurado com sucesso.'
                && ($params['icon'] ?? null) === 'success'
                && ($params['toast'] ?? null) === true);

        $this->assertNotSoftDeleted($item);
    }

    public function test_nome_must_be_unique(): void
    {
        ResponsavelEngenharia::factory()->create(['nome' => 'Nome Duplicado']);

        Livewire::actingAs($this->admin)
            ->test(ResponsaveisEngenhariaCrud::class)
            ->call('openCreateModal')
            ->set('nome', 'Nome Duplicado')
            ->call('save')
            ->assertHasErrors(['nome' => 'unique']);
    }

    public function test_nome_must_be_unique_even_when_inactive(): void
    {
        $item = ResponsavelEngenharia::factory()->create(['nome' => 'Nome Inativo']);
        $item->delete();

        Livewire::actingAs($this->admin)
            ->test(ResponsaveisEngenhariaCrud::class)
            ->call('openCreateModal')
            ->set('nome', 'Nome Inativo')
            ->call('save')
            ->assertHasErrors(['nome' => 'unique']);
    }

    public function test_non_admin_cannot_create_responsavel(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(ResponsaveisEngenhariaCrud::class)
            ->call('openCreateModal')
            ->assertForbidden();
    }
}
