<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\ContratoSolucionador;
use App\Enums\OcorrenciaStatus;
use App\Enums\PrazoUnidade;
use App\Livewire\Admin\OcorrenciasList;
use App\Models\Colaborador;
use App\Models\Ocorrencia;
use App\Models\Prazo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class OcorrenciasListTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private User $prestador;

    private Prazo $prazoNaoEmergencial;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        $this->prestador = User::factory()->prestador()->create();
        $this->prazoNaoEmergencial = Prazo::query()->firstOrCreate(
            ['nome' => 'Engenharia.Inspeção'],
            ['prazo_valor' => 5, 'prazo_unidade' => PrazoUnidade::Dia->value]
        );
    }

    public function test_admin_can_access_ocorrencias_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.ocorrencias'));

        $response->assertStatus(200);
        $response->assertSee('Gestão de Ocorrências');
    }

    public function test_non_admin_cannot_access_ocorrencias_page(): void
    {
        $response = $this->actingAs($this->prestador)->get(route('admin.ocorrencias'));

        $response->assertStatus(403);
    }

    public function test_guest_cannot_access_ocorrencias_page(): void
    {
        $response = $this->get(route('admin.ocorrencias'));

        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_see_ocorrencias_list(): void
    {
        $colaborador = Colaborador::factory()->create(['user_id' => $this->prestador->id]);
        $ocorrencia = Ocorrencia::factory()->create([
            'colaborador_id' => $colaborador->id,
            'titulo' => 'Ocorrência de Teste',
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->assertSee('Ocorrência de Teste')
            ->assertSee($ocorrencia->agencia);
    }

    public function test_admin_can_delete_ocorrencia(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('confirmDelete', $ocorrencia->id)
            ->assertSet('showDeleteModal', true)
            ->assertSet('deletingId', $ocorrencia->id)
            ->call('delete');

        $this->assertDatabaseMissing('ocorrencias', [
            'id' => $ocorrencia->id,
        ]);
    }

    public function test_non_admin_cannot_delete_ocorrencia(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->prestador)
            ->test(OcorrenciasList::class)
            ->call('confirmDelete', $ocorrencia->id)
            ->assertForbidden();
    }

    public function test_search_filters_by_titulo(): void
    {
        Ocorrencia::factory()->create([
            'titulo' => 'Problema no servidor',
            'status' => OcorrenciaStatus::Aberto,
        ]);
        Ocorrencia::factory()->create([
            'titulo' => 'Erro na rede',
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('search', 'servidor')
            ->assertSee('Problema no servidor')
            ->assertDontSee('Erro na rede');
    }

    public function test_search_filters_by_agencia(): void
    {
        Ocorrencia::factory()->create([
            'agencia' => 'Agência Central',
            'titulo' => 'Ocorrência A',
            'status' => OcorrenciaStatus::Aberto,
        ]);
        Ocorrencia::factory()->create([
            'agencia' => 'Agência Norte',
            'titulo' => 'Ocorrência B',
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('search', 'Central')
            ->assertSee('Ocorrência A')
            ->assertDontSee('Ocorrência B');
    }

    public function test_status_filter_works(): void
    {
        Ocorrencia::factory()->create([
            'status' => OcorrenciaStatus::Andamento,
            'titulo' => 'Em andamento',
        ]);
        Ocorrencia::factory()->create([
            'status' => OcorrenciaStatus::Concluido,
            'titulo' => 'Concluída',
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('statusFilter', OcorrenciaStatus::Andamento->value)
            ->assertSee('Em andamento')
            ->assertDontSee('Concluída');
    }

    public function test_default_status_filter_is_aberto_andamento(): void
    {
        Ocorrencia::factory()->create([
            'status' => OcorrenciaStatus::Aberto,
            'titulo' => 'Visível na lista padrão',
        ]);
        Ocorrencia::factory()->create([
            'status' => OcorrenciaStatus::Concluido,
            'titulo' => 'Oculto na lista padrão',
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->assertSet('statusFilter', OcorrenciasList::STATUS_FILTER_ABERTO_ANDAMENTO)
            ->assertSee('Visível na lista padrão')
            ->assertDontSee('Oculto na lista padrão');
    }

    public function test_aberto_andamento_status_filter_shows_aberto_and_andamento_only(): void
    {
        Ocorrencia::factory()->create([
            'status' => OcorrenciaStatus::Aberto,
            'titulo' => 'Ocorrência aberta',
        ]);
        Ocorrencia::factory()->create([
            'status' => OcorrenciaStatus::Andamento,
            'titulo' => 'Ocorrência em andamento',
        ]);
        Ocorrencia::factory()->create([
            'status' => OcorrenciaStatus::Concluido,
            'titulo' => 'Ocorrência concluída',
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('statusFilter', OcorrenciasList::STATUS_FILTER_ABERTO_ANDAMENTO)
            ->assertSee('Ocorrência aberta')
            ->assertSee('Ocorrência em andamento')
            ->assertDontSee('Ocorrência concluída');
    }

    public function test_priority_filter_works(): void
    {
        Ocorrencia::factory()->create([
            'prioridade' => 'Alta',
            'titulo' => 'Ocorrência Alta',
            'status' => OcorrenciaStatus::Aberto,
        ]);
        Ocorrencia::factory()->create([
            'prioridade' => 'Baixa',
            'titulo' => 'Ocorrência Baixa',
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('priorityFilter', 'Alta')
            ->assertSee('Ocorrência Alta')
            ->assertDontSee('Ocorrência Baixa');
    }

    public function test_default_contrato_filter_is_empty_and_includes_ocorrencias_without_contrato(): void
    {
        Ocorrencia::factory()->create([
            'contrato' => ContratoSolucionador::ViaBetonSuregFronteira->value,
            'titulo' => 'Com contrato Fronteira',
            'status' => OcorrenciaStatus::Aberto,
        ]);
        Ocorrencia::factory()->create([
            'contrato' => null,
            'titulo' => 'Sem contrato',
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->assertSet('contratoFilter', '')
            ->assertSee('Todos Contratos')
            ->assertSee(ContratoSolucionador::ViaBetonSuregFronteira->label())
            ->assertSee(ContratoSolucionador::ViaBetonDG->label())
            ->assertSee('Com contrato Fronteira')
            ->assertSee('Sem contrato');
    }

    public function test_contrato_filter_matches_exact_contrato_solucionador(): void
    {
        Ocorrencia::factory()->create([
            'contrato' => ContratoSolucionador::ViaBetonSuregFronteira->value,
            'titulo' => 'Ocorrência Fronteira',
            'status' => OcorrenciaStatus::Aberto,
        ]);
        Ocorrencia::factory()->create([
            'contrato' => ContratoSolucionador::ViaBetonDG->value,
            'titulo' => 'Ocorrência DG',
            'status' => OcorrenciaStatus::Aberto,
        ]);
        Ocorrencia::factory()->create([
            'contrato' => null,
            'titulo' => 'Ocorrência sem contrato',
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('contratoFilter', ContratoSolucionador::ViaBetonDG->value)
            ->assertSee('Ocorrência DG')
            ->assertDontSee('Ocorrência Fronteira')
            ->assertDontSee('Ocorrência sem contrato');
    }

    public function test_contrato_filter_reads_from_url_query_string(): void
    {
        Ocorrencia::factory()->create([
            'contrato' => ContratoSolucionador::ViaBetonSuregFronteira->value,
            'titulo' => 'Ocorrência Fronteira URL',
            'status' => OcorrenciaStatus::Aberto,
        ]);
        Ocorrencia::factory()->create([
            'contrato' => ContratoSolucionador::ViaBetonDG->value,
            'titulo' => 'Ocorrência DG URL',
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->withQueryParams(['contrato' => ContratoSolucionador::ViaBetonSuregFronteira->value])
            ->test(OcorrenciasList::class)
            ->assertSet('contratoFilter', ContratoSolucionador::ViaBetonSuregFronteira->value)
            ->assertSee('Ocorrência Fronteira URL')
            ->assertDontSee('Ocorrência DG URL');
    }

    public function test_close_delete_modal_resets_state(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('confirmDelete', $ocorrencia->id)
            ->assertSet('showDeleteModal', true)
            ->call('closeDeleteModal')
            ->assertSet('showDeleteModal', false)
            ->assertSet('deletingId', null);
    }

    public function test_emergencial_ocorrencias_appear_first(): void
    {
        $prazoEmergencial = Prazo::query()->firstOrCreate(
            ['nome' => Prazo::EMERGENCIAL],
            ['prazo_valor' => 6, 'prazo_unidade' => 'hora']
        );
        $prazoNormal = Prazo::query()->firstOrCreate(
            ['nome' => 'Engenharia.Inspeção'],
            ['prazo_valor' => 5, 'prazo_unidade' => 'dia']
        );

        Ocorrencia::factory()->create([
            'prazo_id' => $prazoNormal->id,
            'titulo' => 'Ocorrência Normal',
            'abertura' => now(),
            'status' => OcorrenciaStatus::Aberto,
        ]);
        Ocorrencia::factory()->create([
            'prazo_id' => $prazoEmergencial->id,
            'titulo' => 'Ocorrência Emergencial',
            'abertura' => now()->subDays(5),
            'status' => OcorrenciaStatus::Aberto,
        ]);

        $html = Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->html();

        $emergencialPos = strpos($html, 'Ocorrência Emergencial');
        $normalPos = strpos($html, 'Ocorrência Normal');

        $this->assertNotFalse($emergencialPos);
        $this->assertNotFalse($normalPos);
        $this->assertLessThan($normalPos, $emergencialPos);
    }

    public function test_emergencial_ocorrencia_row_is_highlighted(): void
    {
        $prazoEmergencial = Prazo::query()->firstOrCreate(
            ['nome' => Prazo::EMERGENCIAL],
            ['prazo_valor' => 6, 'prazo_unidade' => 'hora']
        );

        Ocorrencia::factory()->create([
            'prazo_id' => $prazoEmergencial->id,
            'titulo' => 'Ocorrência Emergencial',
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->assertSee('Ocorrência Emergencial')
            ->assertSeeHtml('bg-danger/10 border-l-4 border-l-danger');
    }

    public function test_non_emergencial_row_is_not_highlighted(): void
    {
        $prazoNormal = Prazo::query()->firstOrCreate(
            ['nome' => 'Engenharia.Inspeção'],
            ['prazo_valor' => 5, 'prazo_unidade' => 'dia']
        );

        Ocorrencia::factory()->create([
            'prazo_id' => $prazoNormal->id,
            'titulo' => 'Ocorrência Normal',
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->assertSee('Ocorrência Normal')
            ->assertDontSeeHtml('bg-danger/10 border-l-4 border-l-danger');
    }

    public function test_categoria_column_shows_prazo_nome(): void
    {
        $prazo = Prazo::query()->firstOrCreate(
            ['nome' => 'Engenharia.Vistoria e confecção'],
            ['prazo_valor' => 5, 'prazo_unidade' => 'dia']
        );

        Ocorrencia::factory()->create([
            'prazo_id' => $prazo->id,
            'titulo' => 'Ocorrência Vistoria',
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->assertSee('Vistoria e confecção');
    }

    public function test_list_shows_prioridade_and_violacao_projetada_columns(): void
    {
        $violacao = now()->addDay()->startOfMinute();

        $ocorrencia = Ocorrencia::factory()->create([
            'prioridade' => 'Alta',
            'violacao_projetada' => $violacao,
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->assertSee('Prioridade')
            ->assertSee('Violação Projetada')
            ->assertSee('Alta')
            ->assertSee($violacao->format('d/m/Y H:i'));
    }

    public function test_list_refreshes_when_ocorrencia_saved_event_is_dispatched(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->dispatch('ocorrencia-saved')
            ->assertOk();
    }

    public function test_list_shows_ordem_column(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->assertSee('Ordem');
    }

    public function test_admin_can_update_ordem_prestador(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'prazo_id' => $this->prazoNaoEmergencial->id,
            'ordem_prestador' => null,
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('ordemPrestadorInputs.'.$ocorrencia->id, 42);

        $this->assertDatabaseHas('ocorrencias', [
            'id' => $ocorrencia->id,
            'ordem_prestador' => 42,
        ]);
    }

    public function test_admin_can_clear_ordem_prestador_to_null(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'prazo_id' => $this->prazoNaoEmergencial->id,
            'ordem_prestador' => 8,
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('ordemPrestadorInputs.'.$ocorrencia->id, '');

        $this->assertDatabaseHas('ocorrencias', [
            'id' => $ocorrencia->id,
            'ordem_prestador' => null,
        ]);
    }

    public function test_admin_cannot_set_ordem_out_of_range(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'prazo_id' => $this->prazoNaoEmergencial->id,
            'ordem_prestador' => 5,
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('ordemPrestadorInputs.'.$ocorrencia->id, 100)
            ->assertHasErrors('ordemPrestadorInputs.'.$ocorrencia->id);

        $this->assertDatabaseHas('ocorrencias', [
            'id' => $ocorrencia->id,
            'ordem_prestador' => 5,
        ]);
    }

    public function test_non_admin_cannot_update_ordem_prestador(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'prazo_id' => $this->prazoNaoEmergencial->id,
            'ordem_prestador' => null,
            'status' => OcorrenciaStatus::Aberto,
        ]);

        Livewire::actingAs($this->prestador)
            ->test(OcorrenciasList::class)
            ->set('ordemPrestadorInputs.'.$ocorrencia->id, 1)
            ->assertForbidden();
    }

    public function test_ordem_input_is_hidden_for_emergencial_ocorrencia(): void
    {
        $emergencial = Ocorrencia::factory()->emergencial()->create([
            'ordem_prestador' => 3,
            'titulo' => 'Ocorrência emergencial ordem oculta',
            'status' => OcorrenciaStatus::Aberto,
        ]);

        $html = Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->html();

        $this->assertStringNotContainsString(
            'wire:model.live.debounce.500ms="ordemPrestadorInputs.'.$emergencial->id.'"',
            $html
        );
        $this->assertStringContainsString('Ocorrência emergencial ordem oculta', $html);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('ordemPrestadorInputs.'.$emergencial->id, 99);

        $this->assertDatabaseHas('ocorrencias', [
            'id' => $emergencial->id,
            'ordem_prestador' => 3,
        ]);
    }
}
