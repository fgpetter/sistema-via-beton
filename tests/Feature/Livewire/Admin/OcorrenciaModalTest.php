<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\ContratoSolucionador;
use App\Enums\OcorrenciaStatus;
use App\Livewire\Admin\OcorrenciaFotoGaleria;
use App\Livewire\Admin\OcorrenciaModal;
use App\Mail\OcorrenciaCriada;
use App\Models\Colaborador;
use App\Models\Disciplina;
use App\Models\Ocorrencia;
use App\Models\Prazo;
use App\Models\ResponsavelEngenharia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use SweetAlert2\Laravel\Swal;
use Tests\TestCase;

class OcorrenciaModalTest extends TestCase
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

    public function test_admin_can_create_ocorrencia(): void
    {
        Mail::fake();

        $colaborador = Colaborador::factory()->create(['user_id' => $this->prestador->id]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
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
            ->assertDispatched('ocorrencia-saved')
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
            ->test(OcorrenciaModal::class)
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
            ->test(OcorrenciaModal::class)
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
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->set('form.titulo', 'Editado')
            ->call('save')
            ->assertHasNoErrors();

        $ocorrencia->refresh();
        $this->assertEquals('Editado', $ocorrencia->titulo);
        $this->assertEquals($originalDate->format('Y-m-d H:i'), $ocorrencia->email_enviado->format('Y-m-d H:i'));
    }

    public function test_open_edit_modal_hydrates_null_titulo_and_agencia_as_empty_string(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'titulo' => null,
            'agencia' => null,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->assertSet('form.titulo', '')
            ->assertSet('form.agencia', '')
            ->assertHasNoErrors();
    }

    public function test_edit_modal_shows_readonly_contrato_solucionador_label(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'contrato' => ContratoSolucionador::ViaBetonSuregFronteira->value,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->assertSet('form.contratoLabel', ContratoSolucionador::ViaBetonSuregFronteira->label())
            ->assertSee('Contrato Solucionador')
            ->assertSee(ContratoSolucionador::ViaBetonSuregFronteira->label())
            ->assertSeeHtml('id="contratoSolucionador"')
            ->assertSeeHtml('readonly');
    }

    public function test_edit_modal_shows_empty_contrato_label_when_ocorrencia_has_no_contrato(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'contrato' => null,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->assertSet('form.contratoLabel', '');
    }

    public function test_save_does_not_persist_contrato_label_changes(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'contrato' => ContratoSolucionador::ViaBetonDG->value,
            'titulo' => 'Original',
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->set('form.titulo', 'Editado')
            ->set('form.contratoLabel', 'valor adulterado')
            ->call('save')
            ->assertHasNoErrors();

        $ocorrencia->refresh();

        $this->assertSame('Editado', $ocorrencia->titulo);
        $this->assertSame(ContratoSolucionador::ViaBetonDG->value, $ocorrencia->contrato);
    }

    public function test_create_ocorrencia_validation_requires_titulo(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
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
            ->test(OcorrenciaModal::class)
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
            ->test(OcorrenciaModal::class)
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
            ->test(OcorrenciaModal::class)
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
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Teste')
            ->set('form.status', 'invalido')
            ->set('form.abertura', '2026-02-18')
            ->set('form.agencia', 'Agência')
            ->call('save')
            ->assertHasErrors(['form.status']);
    }

    public function test_edit_modal_shows_data_chegada_and_saida_inputs(): void
    {
        $ocorrencia = Ocorrencia::factory()->emAndamento()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->assertSee('Data de Chegada')
            ->assertSee('Data de Saída')
            ->assertSeeHtml('wire:model="form.dataChegada"')
            ->assertSeeHtml('wire:model="form.dataSaida"');
    }

    public function test_create_modal_shows_data_chegada_and_saida_inputs(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->assertSee('Data de Chegada')
            ->assertSee('Data de Saída');
    }

    public function test_open_edit_modal_hydrates_data_chegada_and_saida(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'data_chegada' => '2026-03-20',
            'data_saida' => '2026-03-21',
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->assertSet('form.dataChegada', '2026-03-20')
            ->assertSet('form.dataSaida', '2026-03-21');
    }

    public function test_admin_can_edit_data_chegada_and_saida_in_any_status(): void
    {
        $ocorrencia = Ocorrencia::factory()->emAndamento()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->set('form.dataChegada', '2026-03-20')
            ->set('form.dataSaida', '2026-03-21')
            ->call('save')
            ->assertHasNoErrors();

        $ocorrencia->refresh();
        $this->assertEquals('2026-03-20', $ocorrencia->data_chegada->toDateString());
        $this->assertEquals('2026-03-21', $ocorrencia->data_saida->toDateString());
    }

    public function test_admin_filling_data_chegada_on_aberto_sets_andamento(): void
    {
        $ocorrencia = Ocorrencia::factory()->aberto()->create([
            'data_chegada' => null,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->set('form.dataChegada', '2026-03-20')
            ->call('save')
            ->assertHasNoErrors();

        $ocorrencia->refresh();
        $this->assertEquals(OcorrenciaStatus::Andamento, $ocorrencia->status);
        $this->assertEquals('2026-03-20', $ocorrencia->data_chegada->toDateString());
    }

    public function test_admin_filling_data_chegada_on_espera_does_not_change_status(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'status' => OcorrenciaStatus::Espera,
            'data_chegada' => null,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->set('form.dataChegada', '2026-03-20')
            ->call('save')
            ->assertHasNoErrors();

        $ocorrencia->refresh();
        $this->assertEquals(OcorrenciaStatus::Espera, $ocorrencia->status);
        $this->assertEquals('2026-03-20', $ocorrencia->data_chegada->toDateString());
    }

    public function test_admin_blank_datas_do_not_persist_null(): void
    {
        $ocorrencia = Ocorrencia::factory()->revisar()->create([
            'data_chegada' => '2026-03-20',
            'data_saida' => '2026-03-21',
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->set('form.dataChegada', '')
            ->set('form.dataSaida', '')
            ->call('save')
            ->assertHasNoErrors();

        $ocorrencia->refresh();
        $this->assertEquals('2026-03-20', $ocorrencia->data_chegada->toDateString());
        $this->assertEquals('2026-03-21', $ocorrencia->data_saida->toDateString());
    }

    public function test_invalid_data_chegada_is_rejected(): void
    {
        $ocorrencia = Ocorrencia::factory()->revisar()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->set('form.dataChegada', 'nao-e-data')
            ->call('save')
            ->assertHasErrors(['form.dataChegada']);
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
            ->test(OcorrenciaModal::class)
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

    public function test_close_modal_resets_form(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->assertSet('showModal', true)
            ->set('form.titulo', 'Teste')
            ->call('closeModal')
            ->assertSet('showModal', false)
            ->assertSet('form.titulo', '');
    }

    public function test_modal_closes_when_escape_key_is_pressed(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->assertSeeHtml('x-on:keydown.escape.window="if (showModal) $wire.closeModal()"');
    }

    public function test_close_modal_does_not_dispatch_ocorrencia_saved(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->call('closeModal')
            ->assertNotDispatched('ocorrencia-saved');
    }

    public function test_admin_can_concluir_revisao(): void
    {
        $ocorrencia = Ocorrencia::factory()->revisar()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->assertSet('showModal', true)
            ->call('concluirRevisao', $ocorrencia->id)
            ->assertHasNoErrors()
            ->assertSet('showModal', false)
            ->assertDispatched('ocorrencia-saved');

        $ocorrencia->refresh();
        $this->assertEquals(OcorrenciaStatus::Concluido, $ocorrencia->status);
        $this->assertEquals($this->admin->id, $ocorrencia->concluido_por);
    }

    public function test_admin_cannot_concluir_revisao_with_wrong_status(): void
    {
        $ocorrencia = Ocorrencia::factory()->emAndamento()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('concluirRevisao', $ocorrencia->id)
            ->assertForbidden();
    }

    public function test_non_admin_cannot_concluir_revisao(): void
    {
        $ocorrencia = Ocorrencia::factory()->revisar()->create();

        Livewire::actingAs($this->prestador)
            ->test(OcorrenciaModal::class)
            ->call('concluirRevisao', $ocorrencia->id)
            ->assertForbidden();
    }

    public function test_edit_to_concluido_sets_concluido_por(): void
    {
        $ocorrencia = Ocorrencia::factory()->revisar()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->set('form.status', OcorrenciaStatus::Concluido->value)
            ->call('save')
            ->assertHasNoErrors();

        $ocorrencia->refresh();
        $this->assertEquals(OcorrenciaStatus::Concluido, $ocorrencia->status);
        $this->assertEquals($this->admin->id, $ocorrencia->concluido_por);
    }

    public function test_edit_modal_shows_link_to_rat_pdf_when_enviada_and_stored(): void
    {
        Storage::fake('public');

        $ocorrencia = Ocorrencia::factory()->create([
            'email_rat_enviado' => now(),
        ]);
        $path = 'ocorrencias/'.$ocorrencia->id.'/rat/RAT-'.$ocorrencia->id.'.pdf';
        Storage::disk('public')->put($path, '%PDF-1.4 test');
        $ocorrencia->update(['rat_pdf_path' => $path]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->assertSee('Visualizar PDF da RAT')
            ->assertSee(route('admin.ocorrencias.rat-pdf', $ocorrencia), false);
    }

    public function test_edit_modal_includes_ocorrencia_foto_galeria_component(): void
    {
        Livewire::withoutLazyLoading();

        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->assertSeeLivewire(OcorrenciaFotoGaleria::class)
            ->assertSee('dropOnAntes');
    }

    public function test_non_admin_cannot_create_ocorrencia(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->assertForbidden();
    }

    public function test_non_admin_cannot_edit_ocorrencia(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->prestador)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->assertForbidden();
    }

    public function test_admin_can_create_ocorrencia_with_prazo(): void
    {
        Mail::fake();

        $prazo = Prazo::query()->firstOrCreate(
            ['nome' => Prazo::EMERGENCIAL],
            ['prazo_valor' => 6, 'prazo_unidade' => 'hora']
        );

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Emergência Teste')
            ->set('form.status', OcorrenciaStatus::Aberto->value)
            ->set('form.abertura', '2026-03-06')
            ->set('form.agencia', 'Agência Central')
            ->set('form.prazoId', $prazo->id)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencias', [
            'titulo' => 'Emergência Teste',
            'prazo_id' => $prazo->id,
        ]);
    }

    public function test_admin_can_save_ocorrencia_with_disciplinas(): void
    {
        Mail::fake();

        $disciplina = Disciplina::factory()->create(['disciplina' => 'Hidráulica']);
        $sub1 = Disciplina::factory()->subdisciplina()->create(['disciplina' => 'Sub A']);
        $sub2 = Disciplina::factory()->subdisciplina()->create(['disciplina' => 'Sub B']);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Com disciplinas')
            ->set('form.status', OcorrenciaStatus::Aberto->value)
            ->set('form.abertura', '2026-06-01')
            ->set('form.agencia', 'Agência Central')
            ->set('form.disciplinaId', $disciplina->id)
            ->set('form.subdisciplina1Id', $sub1->id)
            ->set('form.subdisciplina2Id', $sub2->id)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencias', [
            'titulo' => 'Com disciplinas',
            'disciplina_id' => $disciplina->id,
            'subdisciplina_1_id' => $sub1->id,
            'subdisciplina_2_id' => $sub2->id,
            'subdisciplina_3_id' => null,
        ]);
    }

    public function test_cannot_use_subdisciplina_as_disciplina_principal(): void
    {
        $sub = Disciplina::factory()->subdisciplina()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Inválida')
            ->set('form.status', OcorrenciaStatus::Aberto->value)
            ->set('form.abertura', '2026-06-01')
            ->set('form.agencia', 'Agência Central')
            ->set('form.disciplinaId', $sub->id)
            ->call('save')
            ->assertHasErrors(['form.disciplinaId']);
    }

    public function test_cannot_repeat_disciplina_ids_on_ocorrencia(): void
    {
        $sub = Disciplina::factory()->subdisciplina()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Duplicada')
            ->set('form.status', OcorrenciaStatus::Aberto->value)
            ->set('form.abertura', '2026-06-01')
            ->set('form.agencia', 'Agência Central')
            ->set('form.subdisciplina1Id', $sub->id)
            ->set('form.subdisciplina2Id', $sub->id)
            ->call('save')
            ->assertHasErrors();

        $this->assertDatabaseMissing('ocorrencias', [
            'titulo' => 'Duplicada',
        ]);
    }

    public function test_admin_can_save_ocorrencia_without_disciplinas(): void
    {
        Mail::fake();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Sem disciplinas')
            ->set('form.status', OcorrenciaStatus::Aberto->value)
            ->set('form.abertura', '2026-06-01')
            ->set('form.agencia', 'Agência Central')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencias', [
            'titulo' => 'Sem disciplinas',
            'disciplina_id' => null,
            'subdisciplina_1_id' => null,
            'subdisciplina_2_id' => null,
            'subdisciplina_3_id' => null,
        ]);
    }

    public function test_admin_can_save_responsavel_engenharia_banrisul_on_create(): void
    {
        Mail::fake();

        $responsavelId = $this->idResponsavelEngenharia('Dustin Hofman');

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Com responsável Banrisul')
            ->set('form.status', OcorrenciaStatus::Aberto->value)
            ->set('form.abertura', '2026-06-01')
            ->set('form.agencia', 'Agência Central')
            ->set('form.responsavelEngenhariaId', $responsavelId)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencias', [
            'titulo' => 'Com responsável Banrisul',
            'responsavel_engenharia_id' => $responsavelId,
        ]);
    }

    public function test_admin_can_update_responsavel_engenharia_banrisul_on_edit(): void
    {
        $dustinId = $this->idResponsavelEngenharia('Dustin Hofman');
        $icaroId = $this->idResponsavelEngenharia('Icaro Dupont');
        $ocorrencia = Ocorrencia::factory()->create([
            'responsavel_engenharia_id' => $dustinId,
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->set('form.responsavelEngenhariaId', $icaroId)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencias', [
            'id' => $ocorrencia->id,
            'responsavel_engenharia_id' => $icaroId,
        ]);
    }

    public function test_admin_can_clear_responsavel_engenharia_banrisul(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'responsavel_engenharia_id' => $this->idResponsavelEngenharia('Dustin Hofman'),
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->set('form.responsavelEngenhariaId', null)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencias', [
            'id' => $ocorrencia->id,
            'responsavel_engenharia_id' => null,
        ]);
    }

    public function test_invalid_responsavel_engenharia_banrisul_is_rejected(): void
    {
        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openCreateModal')
            ->set('form.titulo', 'Responsável inválido')
            ->set('form.status', OcorrenciaStatus::Aberto->value)
            ->set('form.abertura', '2026-06-01')
            ->set('form.agencia', 'Agência Central')
            ->set('form.responsavelEngenhariaId', 999999)
            ->call('save')
            ->assertHasErrors(['form.responsavelEngenhariaId']);

        $this->assertDatabaseMissing('ocorrencias', [
            'titulo' => 'Responsável inválido',
        ]);
    }

    public function test_ocorrencia_with_inactive_responsavel_keeps_selection_on_save(): void
    {
        $responsavel = ResponsavelEngenharia::query()->where('nome', 'Dustin Hofman')->firstOrFail();
        $ocorrencia = Ocorrencia::factory()->create([
            'responsavel_engenharia_id' => $responsavel->id,
        ]);
        $responsavel->delete();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaModal::class)
            ->call('openEditModal', $ocorrencia->id)
            ->assertSet('form.responsavelEngenhariaId', $responsavel->id)
            ->assertSee('Dustin Hofman')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencias', [
            'id' => $ocorrencia->id,
            'responsavel_engenharia_id' => $responsavel->id,
        ]);
    }

    private function idResponsavelEngenharia(string $nome): int
    {
        return (int) ResponsavelEngenharia::query()->where('nome', $nome)->value('id');
    }
}
