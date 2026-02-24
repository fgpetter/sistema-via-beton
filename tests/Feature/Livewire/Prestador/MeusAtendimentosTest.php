<?php

namespace Tests\Feature\Livewire\Prestador;

use App\Enums\OcorrenciaStatus;
use App\Livewire\Prestador\MeusAtendimentos;
use App\Models\Colaborador;
use App\Models\Ocorrencia;
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
}
