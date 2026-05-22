<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\PreventivaStatus;
use App\Livewire\Admin\PreventivasList;
use App\Models\Colaborador;
use App\Models\Preventiva;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PreventivasListTest extends TestCase
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

    public function test_admin_can_access_preventivas_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.preventivas'));

        $response->assertStatus(200);
        $response->assertSee('Gestão de Preventivas');
    }

    public function test_non_admin_cannot_access_preventivas_page(): void
    {
        $response = $this->actingAs($this->prestador)->get(route('admin.preventivas'));

        $response->assertStatus(403);
    }

    public function test_guest_cannot_access_preventivas_page(): void
    {
        $response = $this->get(route('admin.preventivas'));

        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_see_preventivas_list(): void
    {
        $colaborador = Colaborador::factory()->create(['user_id' => $this->prestador->id]);
        $preventiva = Preventiva::factory()->create([
            'colaborador_id' => $colaborador->id,
            'titulo' => 'Preventiva de Teste',
            'status' => PreventivaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivasList::class)
            ->assertSee('Preventiva de Teste')
            ->assertSee($preventiva->agencia);
    }

    public function test_admin_can_delete_preventiva(): void
    {
        $preventiva = Preventiva::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(PreventivasList::class)
            ->call('confirmDelete', $preventiva->id)
            ->assertSet('showDeleteModal', true)
            ->assertSet('deletingId', $preventiva->id)
            ->call('delete');

        $this->assertDatabaseMissing('preventivas', [
            'id' => $preventiva->id,
        ]);
    }

    public function test_non_admin_cannot_delete_preventiva(): void
    {
        $preventiva = Preventiva::factory()->create();

        Livewire::actingAs($this->prestador)
            ->test(PreventivasList::class)
            ->call('confirmDelete', $preventiva->id)
            ->assertForbidden();
    }

    public function test_search_filters_by_titulo(): void
    {
        Preventiva::factory()->create([
            'titulo' => 'Problema no servidor',
            'status' => PreventivaStatus::Aberto,
        ]);
        Preventiva::factory()->create([
            'titulo' => 'Erro na rede',
            'status' => PreventivaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivasList::class)
            ->set('search', 'servidor')
            ->assertSee('Problema no servidor')
            ->assertDontSee('Erro na rede');
    }

    public function test_search_filters_by_agencia(): void
    {
        Preventiva::factory()->create([
            'agencia' => 'Agência Central',
            'titulo' => 'Preventiva A',
            'status' => PreventivaStatus::Aberto,
        ]);
        Preventiva::factory()->create([
            'agencia' => 'Agência Norte',
            'titulo' => 'Preventiva B',
            'status' => PreventivaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivasList::class)
            ->set('search', 'Central')
            ->assertSee('Preventiva A')
            ->assertDontSee('Preventiva B');
    }

    public function test_status_filter_works(): void
    {
        Preventiva::factory()->create([
            'status' => PreventivaStatus::Aberto,
            'titulo' => 'Em aberto',
        ]);
        Preventiva::factory()->create([
            'status' => PreventivaStatus::Concluido,
            'titulo' => 'Concluída',
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivasList::class)
            ->set('statusFilter', PreventivaStatus::Aberto->value)
            ->assertSee('Em aberto')
            ->assertDontSee('Concluída');
    }

    public function test_list_hides_draft_preventivas(): void
    {
        Preventiva::factory()->create([
            'titulo' => 'Rascunho',
            'agencia' => 'A definir',
            'status' => PreventivaStatus::Aberto,
        ]);
        Preventiva::factory()->create([
            'titulo' => 'Preventiva Publicada',
            'status' => PreventivaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivasList::class)
            ->assertSee('Preventiva Publicada')
            ->assertDontSee('Rascunho');
    }

    public function test_close_delete_modal_resets_state(): void
    {
        $preventiva = Preventiva::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(PreventivasList::class)
            ->call('confirmDelete', $preventiva->id)
            ->assertSet('showDeleteModal', true)
            ->call('closeDeleteModal')
            ->assertSet('showDeleteModal', false)
            ->assertSet('deletingId', null);
    }

    public function test_list_shows_imagens_count(): void
    {
        $preventiva = Preventiva::factory()->create();
        $preventiva->imagens()->create(['path' => 'test/foto.jpg']);

        Livewire::actingAs($this->admin)
            ->test(PreventivasList::class)
            ->assertSee('1');
    }

    public function test_list_refreshes_when_preventiva_saved_event_is_dispatched(): void
    {
        Livewire::actingAs($this->admin)
            ->test(PreventivasList::class)
            ->dispatch('preventiva-saved')
            ->assertOk();
    }

    public function test_list_shows_pdf_links_when_relatorios_disponiveis(): void
    {
        $preventiva = Preventiva::factory()->create([
            'status' => PreventivaStatus::Aberto,
            'descricao' => 'Descrição da preventiva',
        ]);
        $preventiva->imagens()->create(['path' => 'test/foto.jpg']);

        Livewire::actingAs($this->admin)
            ->test(PreventivasList::class)
            ->assertSee('Relatório Técnico Fotográfico', false)
            ->assertSee('Relatório Executivo');
    }

    public function test_list_does_not_show_pdf_links_when_relatorios_indisponiveis(): void
    {
        Preventiva::factory()->create([
            'status' => PreventivaStatus::Aberto,
            'descricao' => null,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivasList::class)
            ->assertDontSee('title="Relatório Técnico Fotográfico"', false)
            ->assertDontSee('title="Relatório Executivo"', false);
    }

    public function test_list_shows_recusadas_count_badge(): void
    {
        $preventiva = Preventiva::factory()->create();
        $preventiva->imagens()->create(['path' => 'test/foto.jpg', 'recusada' => true]);

        Livewire::actingAs($this->admin)
            ->test(PreventivasList::class)
            ->assertSee('1 recusada(s)');
    }
}
