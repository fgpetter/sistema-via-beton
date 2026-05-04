<?php

namespace Tests\Feature\Livewire\Prestador;

use App\Enums\OcorrenciaStatus;
use App\Enums\PrazoUnidade;
use App\Livewire\Prestador\MeusAtendimentos;
use App\Models\Colaborador;
use App\Models\Ocorrencia;
use App\Models\Prazo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MeusAtendimentosTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private User $prestador;

    private Colaborador $colaborador;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        $this->prestador = User::factory()->prestador()->create();
        $this->colaborador = Colaborador::factory()->create(['user_id' => $this->prestador->id]);
    }

    public function test_prestador_can_access_atendimentos_page(): void
    {
        $response = $this->actingAs($this->prestador)->get(route('prestador.atendimentos'));

        $response->assertStatus(200);
        $response->assertSee('Meus Atendimentos');
    }

    public function test_guest_cannot_access_atendimentos_page(): void
    {
        $response = $this->get(route('prestador.atendimentos'));

        $response->assertRedirect(route('login'));
    }

    public function test_prestador_sees_only_own_ocorrencias(): void
    {
        $outroPrestador = User::factory()->prestador()->create();
        $outroColaborador = Colaborador::factory()->create(['user_id' => $outroPrestador->id]);

        Ocorrencia::factory()->create([
            'colaborador_id' => $this->colaborador->id,
            'titulo' => 'Minha Ocorrência',
        ]);
        Ocorrencia::factory()->create([
            'colaborador_id' => $outroColaborador->id,
            'titulo' => 'Ocorrência do Outro',
        ]);

        Livewire::actingAs($this->prestador)
            ->test(MeusAtendimentos::class)
            ->assertSee('Minha Ocorrência')
            ->assertDontSee('Ocorrência do Outro');
    }

    public function test_prestador_sees_empty_state_without_ocorrencias(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(MeusAtendimentos::class)
            ->assertSee('Nenhum atendimento designado a você.');
    }

    public function test_prestador_sees_ocorrencia_details_in_card(): void
    {
        Ocorrencia::factory()->create([
            'colaborador_id' => $this->colaborador->id,
            'titulo' => 'Tomada Quebrada',
            'agencia' => 'Agência Rio Claro',
            'status' => OcorrenciaStatus::Andamento,
        ]);

        Livewire::actingAs($this->prestador)
            ->test(MeusAtendimentos::class)
            ->assertSee('Tomada Quebrada')
            ->assertSee('Agência Rio Claro')
            ->assertSee('Em Andamento');
    }

    public function test_prestador_ocorrencias_are_ordered_by_ordem_prestador_then_abertura_with_emergenciais_first(): void
    {
        $prazoNormal = Prazo::query()->firstOrCreate(
            ['nome' => 'Engenharia.Inspeção'],
            ['prazo_valor' => 5, 'prazo_unidade' => PrazoUnidade::Dia->value]
        );
        $prazoEmergencial = Prazo::query()->firstOrCreate(
            ['nome' => Prazo::EMERGENCIAL],
            ['prazo_valor' => 6, 'prazo_unidade' => PrazoUnidade::Hora->value]
        );

        Ocorrencia::factory()->create([
            'colaborador_id' => $this->colaborador->id,
            'prazo_id' => $prazoNormal->id,
            'titulo' => 'LOCK-ord-2',
            'ordem_prestador' => 2,
            'abertura' => '2024-01-15',
        ]);
        Ocorrencia::factory()->create([
            'colaborador_id' => $this->colaborador->id,
            'prazo_id' => $prazoNormal->id,
            'titulo' => 'LOCK-ord-1',
            'ordem_prestador' => 1,
            'abertura' => '2024-01-10',
        ]);
        Ocorrencia::factory()->create([
            'colaborador_id' => $this->colaborador->id,
            'prazo_id' => $prazoNormal->id,
            'titulo' => 'LOCK-sem-ordem',
            'ordem_prestador' => null,
            'abertura' => '2024-02-01',
        ]);
        Ocorrencia::factory()->create([
            'colaborador_id' => $this->colaborador->id,
            'prazo_id' => $prazoNormal->id,
            'titulo' => 'LOCK-empate-a',
            'ordem_prestador' => 3,
            'abertura' => '2024-03-01',
        ]);
        Ocorrencia::factory()->create([
            'colaborador_id' => $this->colaborador->id,
            'prazo_id' => $prazoNormal->id,
            'titulo' => 'LOCK-empate-b',
            'ordem_prestador' => 3,
            'abertura' => '2024-04-01',
        ]);
        Ocorrencia::factory()->create([
            'colaborador_id' => $this->colaborador->id,
            'prazo_id' => $prazoEmergencial->id,
            'titulo' => 'LOCK-prazo-urgente-topo',
            'ordem_prestador' => 99,
            'abertura' => '2024-01-01',
        ]);

        $orderedTitles = Ocorrencia::query()
            ->where('colaborador_id', $this->colaborador->id)
            ->with('prazo')
            ->ordemListaPrestador()
            ->pluck('titulo')
            ->all();

        $this->assertSame([
            'LOCK-prazo-urgente-topo',
            'LOCK-ord-1',
            'LOCK-ord-2',
            'LOCK-empate-b',
            'LOCK-empate-a',
            'LOCK-sem-ordem',
        ], $orderedTitles);

        Livewire::actingAs($this->prestador)
            ->test(MeusAtendimentos::class)
            ->assertSee('LOCK-prazo-urgente-topo')
            ->assertSee('LOCK-ord-1')
            ->assertSee('LOCK-sem-ordem');
    }
}
