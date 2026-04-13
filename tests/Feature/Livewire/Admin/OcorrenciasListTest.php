<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\OcorrenciaStatus;
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

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        $this->prestador = User::factory()->prestador()->create();
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
        Ocorrencia::factory()->create(['titulo' => 'Problema no servidor']);
        Ocorrencia::factory()->create(['titulo' => 'Erro na rede']);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('search', 'servidor')
            ->assertSee('Problema no servidor')
            ->assertDontSee('Erro na rede');
    }

    public function test_search_filters_by_agencia(): void
    {
        Ocorrencia::factory()->create(['agencia' => 'Agência Central', 'titulo' => 'Ocorrência A']);
        Ocorrencia::factory()->create(['agencia' => 'Agência Norte', 'titulo' => 'Ocorrência B']);

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

    public function test_priority_filter_works(): void
    {
        Ocorrencia::factory()->create([
            'prioridade' => 'Alta',
            'titulo' => 'Ocorrência Alta',
        ]);
        Ocorrencia::factory()->create([
            'prioridade' => 'Baixa',
            'titulo' => 'Ocorrência Baixa',
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->set('priorityFilter', 'Alta')
            ->assertSee('Ocorrência Alta')
            ->assertDontSee('Ocorrência Baixa');
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
        ]);
        Ocorrencia::factory()->create([
            'prazo_id' => $prazoEmergencial->id,
            'titulo' => 'Ocorrência Emergencial',
            'abertura' => now()->subDays(5),
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
}
