<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\TipoEndereco;
use App\Livewire\Admin\EnderecosCrud;
use App\Models\Endereco;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use SweetAlert2\Laravel\Swal;
use Tests\TestCase;

class EnderecosCrudTest extends TestCase
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

    public function test_admin_can_access_enderecos_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.enderecos'));

        $response->assertStatus(200);
        $response->assertSee('Endereços');
    }

    public function test_non_admin_cannot_access_enderecos_page(): void
    {
        $response = $this->actingAs($this->prestador)->get(route('admin.enderecos'));

        $response->assertStatus(403);
    }

    public function test_admin_can_create_endereco(): void
    {
        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->call('openCreateModal')
            ->set('nome', 'AG ACEGUA')
            ->set('tipo', TipoEndereco::AGENCIA->value)
            ->set('numero', '1')
            ->set('horario', '08:00 às 17:00')
            ->set('endereco', 'Rua Principal, 123')
            ->set('cidadeEstado', 'Aceguá/RS')
            ->set('fone', '(53) 3000-0000')
            ->set('ativo', true)
            ->call('save')
            ->assertDispatched(Swal::SESSION_KEY, function (string $event, array $params): bool {
                return $event === Swal::SESSION_KEY
                    && ($params['title'] ?? null) === 'Salvo com sucesso!'
                    && ($params['icon'] ?? null) === 'success'
                    && ($params['toast'] ?? null) === true;
            })
            ->assertHasNoErrors();

        $this->assertDatabaseHas('enderecos', [
            'nome' => 'AG ACEGUA',
            'tipo' => TipoEndereco::AGENCIA->value,
            'numero' => '1',
            'horario' => '08:00 às 17:00',
            'endereco' => 'Rua Principal, 123',
            'cidade_estado' => 'Aceguá/RS',
            'fone' => '(53) 3000-0000',
            'ativo' => true,
        ]);
    }

    public function test_admin_can_create_endereco_with_minimal_data(): void
    {
        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->call('openCreateModal')
            ->set('nome', 'AG TESTE')
            ->set('tipo', TipoEndereco::AGENCIA->value)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('enderecos', [
            'nome' => 'AG TESTE',
            'tipo' => TipoEndereco::AGENCIA->value,
            'ativo' => true,
        ]);
    }

    public function test_admin_can_update_endereco(): void
    {
        $endereco = Endereco::factory()->create([
            'nome' => 'AG ANTIGO',
            'tipo' => TipoEndereco::AGENCIA,
            'numero' => '1',
        ]);

        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->call('openEditModal', $endereco->id)
            ->set('nome', 'AG NOVO')
            ->set('numero', '99')
            ->set('ativo', false)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('enderecos', [
            'id' => $endereco->id,
            'nome' => 'AG NOVO',
            'numero' => '99',
            'ativo' => false,
        ]);
    }

    public function test_admin_can_delete_endereco(): void
    {
        $endereco = Endereco::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->call('confirmDelete', $endereco->id)
            ->call('delete');

        $this->assertDatabaseMissing('enderecos', [
            'id' => $endereco->id,
        ]);
    }

    public function test_nome_is_required(): void
    {
        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->call('openCreateModal')
            ->set('nome', '')
            ->set('tipo', TipoEndereco::AGENCIA->value)
            ->call('save')
            ->assertHasErrors(['nome' => 'required']);
    }

    public function test_nome_must_be_unique(): void
    {
        Endereco::factory()->create(['nome' => 'AG DUPLICADO']);

        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->call('openCreateModal')
            ->set('nome', 'AG DUPLICADO')
            ->set('tipo', TipoEndereco::AGENCIA->value)
            ->call('save')
            ->assertHasErrors(['nome' => 'unique']);
    }

    public function test_nome_unique_ignores_self_on_update(): void
    {
        $endereco = Endereco::factory()->create(['nome' => 'AG MESMO']);

        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->call('openEditModal', $endereco->id)
            ->call('save')
            ->assertHasNoErrors();
    }

    public function test_tipo_is_required(): void
    {
        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->call('openCreateModal')
            ->set('nome', 'AG TESTE')
            ->set('tipo', '')
            ->call('save')
            ->assertHasErrors(['tipo' => 'required']);
    }

    public function test_tipo_must_be_valid_enum(): void
    {
        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->call('openCreateModal')
            ->set('nome', 'AG TESTE')
            ->set('tipo', 'invalido')
            ->call('save')
            ->assertHasErrors(['tipo']);
    }

    public function test_non_admin_cannot_create_endereco(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(EnderecosCrud::class)
            ->call('openCreateModal')
            ->assertForbidden();
    }

    public function test_non_admin_cannot_update_endereco(): void
    {
        $endereco = Endereco::factory()->create();

        Livewire::actingAs($this->prestador)
            ->test(EnderecosCrud::class)
            ->call('openEditModal', $endereco->id)
            ->assertForbidden();
    }

    public function test_non_admin_cannot_delete_endereco(): void
    {
        $endereco = Endereco::factory()->create();

        Livewire::actingAs($this->prestador)
            ->test(EnderecosCrud::class)
            ->call('confirmDelete', $endereco->id)
            ->assertForbidden();
    }

    public function test_search_filters_enderecos_by_nome(): void
    {
        Endereco::factory()->create(['nome' => 'AG ACEGUA']);
        Endereco::factory()->create(['nome' => 'AG JOINVILLE']);

        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->set('search', 'ACEGUA')
            ->assertSee('AG ACEGUA')
            ->assertDontSee('AG JOINVILLE');
    }

    public function test_search_filters_enderecos_by_cidade_estado(): void
    {
        Endereco::factory()->create([
            'nome' => 'UNIDADE ALFA',
            'endereco' => 'Rua X, 1',
            'cidade_estado' => 'Tramandai/RS',
        ]);
        Endereco::factory()->create([
            'nome' => 'UNIDADE BETA',
            'endereco' => 'Rua Y, 2',
            'cidade_estado' => 'Canoas/RS',
        ]);

        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->set('search', 'Canoas')
            ->assertSee('UNIDADE BETA')
            ->assertDontSee('UNIDADE ALFA');
    }

    public function test_ativo_filter_shows_only_active(): void
    {
        Endereco::factory()->create(['nome' => 'AG ATIVO', 'ativo' => true]);
        Endereco::factory()->create(['nome' => 'AG INATIVO', 'ativo' => false]);

        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->set('ativoFilter', '1')
            ->assertSee('AG ATIVO')
            ->assertDontSee('AG INATIVO');
    }

    public function test_ativo_filter_shows_only_inactive(): void
    {
        Endereco::factory()->create(['nome' => 'AG ATIVO', 'ativo' => true]);
        Endereco::factory()->create(['nome' => 'AG INATIVO', 'ativo' => false]);

        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->set('ativoFilter', '0')
            ->assertDontSee('AG ATIVO')
            ->assertSee('AG INATIVO');
    }

    public function test_open_edit_modal_loads_data(): void
    {
        $endereco = Endereco::factory()->create([
            'nome' => 'AG TESTE',
            'tipo' => TipoEndereco::AGENCIA,
            'numero' => '42',
            'horario' => '09:00 às 18:00',
            'endereco' => 'Rua Teste, 100',
            'cidade_estado' => 'Porto Alegre/RS',
            'fone' => '(51) 1234-5678',
            'ativo' => true,
        ]);

        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->call('openEditModal', $endereco->id)
            ->assertSet('editingId', $endereco->id)
            ->assertSet('nome', 'AG TESTE')
            ->assertSet('tipo', TipoEndereco::AGENCIA->value)
            ->assertSet('numero', '42')
            ->assertSet('horario', '09:00 às 18:00')
            ->assertSet('endereco', 'Rua Teste, 100')
            ->assertSet('cidadeEstado', 'Porto Alegre/RS')
            ->assertSet('fone', '(51) 1234-5678')
            ->assertSet('ativo', true);
    }

    public function test_close_modal_resets_form(): void
    {
        $endereco = Endereco::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->call('openEditModal', $endereco->id)
            ->call('closeModal')
            ->assertSet('editingId', null)
            ->assertSet('nome', '')
            ->assertSet('showModal', false);
    }

    public function test_pagination_shows_compact_page_links(): void
    {
        Endereco::factory()->count(120)->create();

        Livewire::actingAs($this->admin)
            ->test(EnderecosCrud::class)
            ->call('gotoPage', 6)
            ->assertSee('Anterior')
            ->assertSee('Próximo')
            ->assertSee('...')
            ->assertSee('1')
            ->assertSee('6')
            ->assertSee('12')
            ->assertDontSee('2')
            ->assertDontSee('10');
    }
}
