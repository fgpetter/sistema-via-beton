<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\DisciplinasCrud;
use App\Models\Disciplina;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DisciplinasCrudTest extends TestCase
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

    public function test_admin_can_see_disciplinas_on_configuracoes_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.configuracoes-sistema'));

        $response->assertStatus(200);
        $response->assertSee('Disciplinas');
    }

    public function test_admin_can_create_disciplina(): void
    {
        Livewire::actingAs($this->admin)
            ->test(DisciplinasCrud::class)
            ->call('openCreateModal')
            ->set('disciplina', 'Hidráulica')
            ->set('subdisciplina', false)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('disciplinas', [
            'disciplina' => 'Hidráulica',
            'subdisciplina' => false,
        ]);
    }

    public function test_admin_can_create_subdisciplina(): void
    {
        Livewire::actingAs($this->admin)
            ->test(DisciplinasCrud::class)
            ->call('openCreateModal')
            ->set('disciplina', 'Caixa acoplada')
            ->set('subdisciplina', true)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('disciplinas', [
            'disciplina' => 'Caixa acoplada',
            'subdisciplina' => true,
        ]);
    }

    public function test_admin_can_update_disciplina(): void
    {
        $item = Disciplina::factory()->create(['disciplina' => 'Antiga']);

        Livewire::actingAs($this->admin)
            ->test(DisciplinasCrud::class)
            ->call('openEditModal', $item->id)
            ->set('disciplina', 'Nova')
            ->set('subdisciplina', true)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('disciplinas', [
            'id' => $item->id,
            'disciplina' => 'Nova',
            'subdisciplina' => true,
        ]);
    }

    public function test_admin_can_delete_disciplina(): void
    {
        $item = Disciplina::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(DisciplinasCrud::class)
            ->call('confirmDelete', $item->id)
            ->call('delete');

        $this->assertDatabaseMissing('disciplinas', [
            'id' => $item->id,
        ]);
    }

    public function test_disciplina_name_must_be_unique(): void
    {
        Disciplina::factory()->create(['disciplina' => 'Elétrica']);

        Livewire::actingAs($this->admin)
            ->test(DisciplinasCrud::class)
            ->call('openCreateModal')
            ->set('disciplina', 'Elétrica')
            ->call('save')
            ->assertHasErrors(['disciplina' => 'unique']);
    }

    public function test_non_admin_cannot_create_disciplina(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(DisciplinasCrud::class)
            ->call('openCreateModal')
            ->assertForbidden();
    }
}
