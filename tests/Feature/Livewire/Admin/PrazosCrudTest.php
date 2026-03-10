<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\PrazoUnidade;
use App\Livewire\Admin\PrazosCrud;
use App\Models\Prazo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Livewire\Livewire;
use Tests\TestCase;

class PrazosCrudTest extends TestCase
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

    public function test_admin_can_access_configuracoes_do_sistema_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.configuracoes-sistema'));

        $response->assertStatus(200);
        $response->assertSee('Configurações do sistema');
    }

    public function test_non_admin_cannot_access_configuracoes_do_sistema_page(): void
    {
        $response = $this->actingAs($this->prestador)->get(route('admin.configuracoes-sistema'));

        $response->assertStatus(403);
    }

    public function test_admin_can_create_prazo(): void
    {
        Livewire::actingAs($this->admin)
            ->test(PrazosCrud::class)
            ->call('openCreateModal')
            ->set('nome', 'Engenharia.Teste Prazo')
            ->set('prazoValor', 6)
            ->set('prazoUnidade', PrazoUnidade::Hora->value)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('prazos', [
            'nome' => 'Engenharia.Teste Prazo',
            'prazo_valor' => 6,
            'prazo_unidade' => PrazoUnidade::Hora->value,
        ]);
    }

    public function test_admin_can_update_prazo(): void
    {
        $prazo = Prazo::create([
            'nome' => 'Engenharia.Antigo',
            'prazo_valor' => 5,
            'prazo_unidade' => PrazoUnidade::Dia,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PrazosCrud::class)
            ->call('openEditModal', $prazo->id)
            ->set('nome', 'Engenharia.Novo')
            ->set('prazoValor', 12)
            ->set('prazoUnidade', PrazoUnidade::Hora->value)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('prazos', [
            'id' => $prazo->id,
            'nome' => 'Engenharia.Novo',
            'prazo_valor' => 12,
            'prazo_unidade' => PrazoUnidade::Hora->value,
        ]);
    }

    public function test_admin_can_delete_prazo(): void
    {
        $prazo = Prazo::create([
            'nome' => 'Engenharia.Deletar',
            'prazo_valor' => 3,
            'prazo_unidade' => PrazoUnidade::Dia,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PrazosCrud::class)
            ->call('confirmDelete', $prazo->id)
            ->call('delete');

        $this->assertDatabaseMissing('prazos', [
            'id' => $prazo->id,
        ]);
    }

    public function test_prazo_calculates_deadline_with_hours_and_days(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-03-02 10:00:00'));

        $baseDate = now();
        $prazoHora = new Prazo([
            'prazo_valor' => 6,
            'prazo_unidade' => PrazoUnidade::Hora,
        ]);
        $prazoDia = new Prazo([
            'prazo_valor' => 5,
            'prazo_unidade' => PrazoUnidade::Dia,
        ]);

        $this->assertSame('2026-03-02 16:00:00', $prazoHora->calcularDataLimite($baseDate)->format('Y-m-d H:i:s'));
        $this->assertSame('2026-03-07 10:00:00', $prazoDia->calcularDataLimite($baseDate)->format('Y-m-d H:i:s'));
    }
}
