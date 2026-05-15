<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\PreventivaStatus;
use App\Livewire\Admin\PreventivaFotoGaleria;
use App\Livewire\Admin\PreventivaModal;
use App\Models\Colaborador;
use App\Models\Preventiva;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use SweetAlert2\Laravel\Swal;
use Tests\TestCase;

class PreventivaModalTest extends TestCase
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

    public function test_admin_can_create_preventiva(): void
    {
        $colaborador = Colaborador::factory()->create(['user_id' => $this->prestador->id]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Nova Preventiva')
            ->set('form.status', PreventivaStatus::Aberto->value)
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência Central')
            ->set('form.colaboradorId', $colaborador->id)
            ->set('form.descricao', 'Descrição da preventiva')
            ->call('save')
            ->assertDispatched(Swal::SESSION_KEY, function (string $event, array $params): bool {
                return $event === Swal::SESSION_KEY
                    && ($params['title'] ?? null) === 'Salvo com sucesso!'
                    && ($params['icon'] ?? null) === 'success'
                    && ($params['toast'] ?? null) === true;
            })
            ->assertDispatched('preventiva-saved')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('preventivas', [
            'titulo' => 'Nova Preventiva',
            'status' => PreventivaStatus::Aberto->value,
            'agencia' => 'Agência Central',
            'colaborador_id' => $colaborador->id,
        ]);
    }

    public function test_admin_can_create_preventiva_without_optional_fields(): void
    {
        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Preventiva Mínima')
            ->set('form.status', PreventivaStatus::Aberto->value)
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência Norte')
            ->call('save')
            ->assertHasNoErrors();

        $preventiva = Preventiva::query()->where('titulo', 'Preventiva Mínima')->first();

        $this->assertNotNull($preventiva);
        $this->assertNull($preventiva->colaborador_id);
        $this->assertNull($preventiva->descricao);
        $this->assertNull($preventiva->comentarios);
    }

    public function test_create_preventiva_validation_requires_titulo(): void
    {
        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', '')
            ->set('form.status', PreventivaStatus::Aberto->value)
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência')
            ->call('save')
            ->assertHasErrors(['form.titulo']);
    }

    public function test_create_preventiva_validation_requires_status(): void
    {
        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Teste')
            ->set('form.status', '')
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência')
            ->call('save')
            ->assertHasErrors(['form.status']);
    }

    public function test_create_preventiva_validation_requires_abertura(): void
    {
        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Teste')
            ->set('form.status', PreventivaStatus::Aberto->value)
            ->set('form.abertura', '')
            ->set('form.agencia', 'Agência')
            ->call('save')
            ->assertHasErrors(['form.abertura']);
    }

    public function test_create_preventiva_validation_requires_agencia(): void
    {
        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Teste')
            ->set('form.status', PreventivaStatus::Aberto->value)
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', '')
            ->call('save')
            ->assertHasErrors(['form.agencia']);
    }

    public function test_create_preventiva_validation_rejects_invalid_status(): void
    {
        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Teste')
            ->set('form.status', 'invalido')
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência')
            ->call('save')
            ->assertHasErrors(['form.status']);
    }

    public function test_admin_can_edit_preventiva(): void
    {
        $colaborador = Colaborador::factory()->create(['user_id' => $this->prestador->id]);
        $preventiva = Preventiva::factory()->create([
            'colaborador_id' => $colaborador->id,
            'titulo' => 'Título Original',
            'status' => PreventivaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openEditModal', $preventiva->id)
            ->assertSet('form.titulo', 'Título Original')
            ->assertSet('form.status', PreventivaStatus::Aberto->value)
            ->set('form.titulo', 'Título Editado')
            ->set('form.status', PreventivaStatus::Concluido->value)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('preventivas', [
            'id' => $preventiva->id,
            'titulo' => 'Título Editado',
            'status' => PreventivaStatus::Concluido->value,
        ]);
    }

    public function test_close_modal_resets_form(): void
    {
        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->assertSet('showModal', true)
            ->set('form.titulo', 'Teste')
            ->call('closeModal')
            ->assertSet('showModal', false)
            ->assertSet('form.titulo', '');
    }

    public function test_close_modal_does_not_dispatch_preventiva_saved(): void
    {
        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->call('closeModal')
            ->assertNotDispatched('preventiva-saved');
    }

    public function test_edit_to_concluido_sets_concluido_por(): void
    {
        $preventiva = Preventiva::factory()->aprovado()->create();

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openEditModal', $preventiva->id)
            ->set('form.status', PreventivaStatus::Concluido->value)
            ->call('save')
            ->assertHasNoErrors();

        $preventiva->refresh();
        $this->assertEquals(PreventivaStatus::Concluido, $preventiva->status);
        $this->assertEquals($this->admin->id, $preventiva->concluido_por);
    }

    public function test_create_modal_includes_preventiva_foto_galeria_component(): void
    {
        Livewire::withoutLazyLoading();

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->assertSet('isDraft', true)
            ->assertSeeLivewire(PreventivaFotoGaleria::class);
    }

    public function test_close_modal_deletes_draft_preventiva(): void
    {
        $component = Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->assertSet('isDraft', true);

        $draftId = $component->get('form.editingId');
        $this->assertNotNull($draftId);

        $component
            ->call('closeModal')
            ->assertSet('showModal', false);

        $this->assertDatabaseMissing('preventivas', ['id' => $draftId]);
    }

    public function test_edit_modal_includes_preventiva_foto_galeria_component(): void
    {
        Livewire::withoutLazyLoading();

        $preventiva = Preventiva::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openEditModal', $preventiva->id)
            ->assertSeeLivewire(PreventivaFotoGaleria::class);
    }

    public function test_non_admin_cannot_create_preventiva(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->assertForbidden();
    }

    public function test_non_admin_cannot_edit_preventiva(): void
    {
        $preventiva = Preventiva::factory()->create();

        Livewire::actingAs($this->prestador)
            ->test(PreventivaModal::class)
            ->call('openEditModal', $preventiva->id)
            ->assertForbidden();
    }
}
