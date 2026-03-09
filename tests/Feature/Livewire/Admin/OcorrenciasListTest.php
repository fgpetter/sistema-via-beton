<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\OcorrenciaStatus;
use App\Livewire\Admin\OcorrenciasList;
use App\Mail\OcorrenciaCriada;
use App\Models\Colaborador;
use App\Models\Ocorrencia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use SweetAlert2\Laravel\Swal;
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

    public function test_admin_can_create_ocorrencia(): void
    {
        Mail::fake();

        $colaborador = Colaborador::factory()->create(['user_id' => $this->prestador->id]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Nova Ocorrência')
            ->set('form.status', OcorrenciaStatus::Andamento->value)
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência Central')
            ->set('form.colaboradorId', $colaborador->id)
            ->set('form.descricao', 'Descrição da ocorrência')
            ->call('save')
            ->assertDispatched(Swal::SESSION_KEY, function (string $event, array $params): bool {
                return $event === Swal::SESSION_KEY
                    && ($params['title'] ?? null) === 'Salvo com sucesso!'
                    && ($params['icon'] ?? null) === 'success'
                    && ($params['toast'] ?? null) === true;
            })
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencias', [
            'titulo' => 'Nova Ocorrência',
            'status' => OcorrenciaStatus::Andamento->value,
            'agencia' => 'Agência Central',
            'colaborador_id' => $colaborador->id,
        ]);

        Mail::assertQueued(OcorrenciaCriada::class, function (OcorrenciaCriada $mail) {
            return $mail->ocorrencia->titulo === 'Nova Ocorrência'
                && $mail->hasTo($this->prestador->email);
        });
    }

    public function test_admin_can_create_ocorrencia_without_optional_fields(): void
    {
        Mail::fake();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Ocorrência Mínima')
            ->set('form.status', OcorrenciaStatus::Andamento->value)
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência Norte')
            ->call('save')
            ->assertHasNoErrors();

        $ocorrencia = Ocorrencia::query()->where('titulo', 'Ocorrência Mínima')->first();

        $this->assertNotNull($ocorrencia);
        $this->assertNull($ocorrencia->colaborador_id);
        $this->assertNull($ocorrencia->descricao);
        $this->assertNull($ocorrencia->comentarios);
        $this->assertNull($ocorrencia->email_enviado);

        Mail::assertNotQueued(OcorrenciaCriada::class);
    }

    public function test_create_ocorrencia_sends_email_and_sets_email_enviado(): void
    {
        Mail::fake();
        $this->freezeTime();

        $colaborador = Colaborador::factory()->create(['user_id' => $this->prestador->id]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Ocorrência com Email')
            ->set('form.status', OcorrenciaStatus::Andamento->value)
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência Sul')
            ->set('form.colaboradorId', $colaborador->id)
            ->call('save')
            ->assertHasNoErrors();

        $ocorrencia = Ocorrencia::query()->where('titulo', 'Ocorrência com Email')->first();

        $this->assertNotNull($ocorrencia->email_enviado);
        $this->assertEquals(now()->format('Y-m-d H:i'), $ocorrencia->email_enviado->format('Y-m-d H:i'));

        Mail::assertQueued(OcorrenciaCriada::class, function (OcorrenciaCriada $mail) use ($ocorrencia) {
            return $mail->ocorrencia->id === $ocorrencia->id
                && $mail->hasTo($this->prestador->email);
        });
    }

    public function test_edit_ocorrencia_does_not_change_email_enviado(): void
    {
        $originalDate = now()->subDays(5);
        $ocorrencia = Ocorrencia::factory()->create([
            'titulo' => 'Original',
            'email_enviado' => $originalDate,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('openEditModal', $ocorrencia->id)
            ->set('form.titulo', 'Editado')
            ->call('save')
            ->assertHasNoErrors();

        $ocorrencia->refresh();
        $this->assertEquals('Editado', $ocorrencia->titulo);
        $this->assertEquals($originalDate->format('Y-m-d H:i'), $ocorrencia->email_enviado->format('Y-m-d H:i'));
    }

    public function test_create_ocorrencia_validation_requires_titulo(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('openCreateModal')
            ->set('form.titulo', '')
            ->set('form.status', OcorrenciaStatus::Andamento->value)
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência')
            ->call('save')
            ->assertHasErrors(['form.titulo']);
    }

    public function test_create_ocorrencia_validation_requires_status(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Teste')
            ->set('form.status', '')
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência')
            ->call('save')
            ->assertHasErrors(['form.status']);
    }

    public function test_create_ocorrencia_validation_requires_abertura(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Teste')
            ->set('form.status', OcorrenciaStatus::Andamento->value)
            ->set('form.abertura', '')
            ->set('form.agencia', 'Agência')
            ->call('save')
            ->assertHasErrors(['form.abertura']);
    }

    public function test_create_ocorrencia_validation_requires_agencia(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Teste')
            ->set('form.status', OcorrenciaStatus::Andamento->value)
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', '')
            ->call('save')
            ->assertHasErrors(['form.agencia']);
    }

    public function test_create_ocorrencia_validation_rejects_invalid_status(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Teste')
            ->set('form.status', 'invalido')
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência')
            ->call('save')
            ->assertHasErrors(['form.status']);
    }

    public function test_admin_can_edit_ocorrencia(): void
    {
        $colaborador = Colaborador::factory()->create(['user_id' => $this->prestador->id]);
        $ocorrencia = Ocorrencia::factory()->create([
            'colaborador_id' => $colaborador->id,
            'titulo' => 'Título Original',
            'status' => OcorrenciaStatus::Andamento,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('openEditModal', $ocorrencia->id)
            ->assertSet('form.titulo', 'Título Original')
            ->assertSet('form.status', OcorrenciaStatus::Andamento->value)
            ->set('form.titulo', 'Título Editado')
            ->set('form.status', OcorrenciaStatus::Concluido->value)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencias', [
            'id' => $ocorrencia->id,
            'titulo' => 'Título Editado',
            'status' => OcorrenciaStatus::Concluido->value,
        ]);
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

    public function test_non_admin_cannot_create_ocorrencia(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(OcorrenciasList::class)
            ->call('openCreateModal')
            ->assertForbidden();
    }

    public function test_non_admin_cannot_edit_ocorrencia(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->prestador)
            ->test(OcorrenciasList::class)
            ->call('openEditModal', $ocorrencia->id)
            ->assertForbidden();
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

    public function test_close_modal_resets_form(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciasList::class)
            ->call('openCreateModal')
            ->assertSet('showModal', true)
            ->set('form.titulo', 'Teste')
            ->call('closeModal')
            ->assertSet('showModal', false)
            ->assertSet('form.titulo', '');
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
}
