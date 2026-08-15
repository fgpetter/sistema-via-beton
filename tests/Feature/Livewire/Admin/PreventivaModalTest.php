<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\PreventivaStatus;
use App\Livewire\Admin\PreventivaFotoGaleria;
use App\Livewire\Admin\PreventivaMedicaoGaleria;
use App\Livewire\Admin\PreventivaModal;
use App\Models\Colaborador;
use App\Models\Preventiva;
use App\Models\ResponsavelEngenharia;
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
        $preventiva = Preventiva::factory()->aberto()->create();

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
            ->assertSeeLivewire(PreventivaFotoGaleria::class)
            ->assertSeeLivewire(PreventivaMedicaoGaleria::class);
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
            ->assertSeeLivewire(PreventivaFotoGaleria::class)
            ->assertSeeLivewire(PreventivaMedicaoGaleria::class);
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

    public function test_edit_modal_shows_descricao_helper_when_empty(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => null,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openEditModal', $preventiva->id)
            ->assertSee('Preencha o campo descrição para que o relatório possa ser gerado');
    }

    public function test_edit_modal_hides_descricao_helper_when_filled(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição da preventiva',
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openEditModal', $preventiva->id)
            ->assertDontSee('Preencha o campo descrição para que o relatório possa ser gerado');
    }

    public function test_edit_modal_hides_descricao_helper_after_user_fills_field(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => null,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openEditModal', $preventiva->id)
            ->assertSee('Preencha o campo descrição para que o relatório possa ser gerado')
            ->set('form.descricao', 'Nova descrição')
            ->assertDontSee('Preencha o campo descrição para que o relatório possa ser gerado');
    }

    public function test_admin_can_create_preventiva_with_responsavel_engenharia_banrisul(): void
    {
        $colaborador = Colaborador::factory()->create(['user_id' => $this->prestador->id]);
        $responsavelId = $this->idResponsavelEngenharia('Dustin Hofman');

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Preventiva com Responsável Banrisul')
            ->set('form.status', PreventivaStatus::Aberto->value)
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência Central')
            ->set('form.colaboradorId', $colaborador->id)
            ->set('form.responsavelEngenhariaId', $responsavelId)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('preventivas', [
            'titulo' => 'Preventiva com Responsável Banrisul',
            'responsavel_engenharia_id' => $responsavelId,
        ]);
    }

    public function test_admin_can_update_responsavel_engenharia_banrisul_on_edit(): void
    {
        $dustinId = $this->idResponsavelEngenharia('Dustin Hofman');
        $icaroId = $this->idResponsavelEngenharia('Icaro Dupont');
        $preventiva = Preventiva::factory()->create([
            'responsavel_engenharia_id' => $dustinId,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openEditModal', $preventiva->id)
            ->set('form.responsavelEngenhariaId', $icaroId)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('preventivas', [
            'id' => $preventiva->id,
            'responsavel_engenharia_id' => $icaroId,
        ]);
    }

    public function test_admin_can_clear_responsavel_engenharia_banrisul(): void
    {
        $preventiva = Preventiva::factory()->create([
            'responsavel_engenharia_id' => $this->idResponsavelEngenharia('Dustin Hofman'),
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openEditModal', $preventiva->id)
            ->set('form.responsavelEngenhariaId', null)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('preventivas', [
            'id' => $preventiva->id,
            'responsavel_engenharia_id' => null,
        ]);
    }

    public function test_edit_modal_shows_relatorio_medicao_link_when_par_completo(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição da preventiva',
        ]);
        $imagem = $preventiva->imagens()->create(['path' => 'test/foto.jpg', 'recusada' => false, 'position' => 1]);
        $imagem->medicaoImagens()->create(['path' => 'test/medicao.jpg']);

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openEditModal', $preventiva->id)
            ->assertSee('Relatório de Medição')
            ->assertSee(route('admin.preventivas.relatorio-medicao-pdf', $preventiva));
    }

    public function test_edit_modal_hides_relatorio_medicao_link_without_medicao_imagens(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição da preventiva',
        ]);
        $preventiva->imagens()->create(['path' => 'test/foto.jpg', 'recusada' => false, 'position' => 1]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaModal::class)
            ->call('openEditModal', $preventiva->id)
            ->assertDontSee(route('admin.preventivas.relatorio-medicao-pdf', $preventiva));
    }

    private function idResponsavelEngenharia(string $nome): int
    {
        return (int) ResponsavelEngenharia::query()->where('nome', $nome)->value('id');
    }
}
