<?php

use App\Enums\OcorrenciaStatus;
use App\Livewire\Admin\OcorrenciaModal;
use App\Models\Disciplina;
use App\Models\Ocorrencia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function (): void {
    $this->admin = User::factory()->admin()->create();
});

test('admin pode repetir a mesma subdisciplina em posições diferentes', function (): void {
    $sub = Disciplina::factory()->subdisciplina()->create();

    Livewire::actingAs($this->admin)
        ->test(OcorrenciaModal::class)
        ->call('openCreateModal')
        ->set('form.titulo', 'Repetida')
        ->set('form.status', OcorrenciaStatus::Aberto->value)
        ->set('form.abertura', '2026-06-01')
        ->set('form.agencia', 'Agência Central')
        ->set('form.subdisciplina1Id', $sub->id)
        ->set('form.subdisciplina6Id', $sub->id)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('ocorrencias', [
        'titulo' => 'Repetida',
        'subdisciplina_1_id' => $sub->id,
        'subdisciplina_6_id' => $sub->id,
    ]);
});

test('salva subdisciplinas 4, 5 e 6 na criação', function (): void {
    $disciplina = Disciplina::factory()->create(['disciplina' => 'Hidráulica']);
    $sub1 = Disciplina::factory()->subdisciplina()->create();
    $sub4 = Disciplina::factory()->subdisciplina()->create();
    $sub5 = Disciplina::factory()->subdisciplina()->create();
    $sub6 = Disciplina::factory()->subdisciplina()->create();

    Livewire::actingAs($this->admin)
        ->test(OcorrenciaModal::class)
        ->call('openCreateModal')
        ->set('form.titulo', 'Seis subdisciplinas')
        ->set('form.status', OcorrenciaStatus::Aberto->value)
        ->set('form.abertura', '2026-06-01')
        ->set('form.agencia', 'Agência Central')
        ->set('form.disciplinaId', $disciplina->id)
        ->set('form.subdisciplina1Id', $sub1->id)
        ->set('form.subdisciplina4Id', $sub4->id)
        ->set('form.subdisciplina5Id', $sub5->id)
        ->set('form.subdisciplina6Id', $sub6->id)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('ocorrencias', [
        'titulo' => 'Seis subdisciplinas',
        'subdisciplina_1_id' => $sub1->id,
        'subdisciplina_2_id' => null,
        'subdisciplina_3_id' => null,
        'subdisciplina_4_id' => $sub4->id,
        'subdisciplina_5_id' => $sub5->id,
        'subdisciplina_6_id' => $sub6->id,
    ]);
});

test('edição carrega e persiste subdisciplinas 4, 5 e 6', function (): void {
    $sub4 = Disciplina::factory()->subdisciplina()->create();
    $sub5 = Disciplina::factory()->subdisciplina()->create();
    $sub6 = Disciplina::factory()->subdisciplina()->create();
    $novaSub6 = Disciplina::factory()->subdisciplina()->create();
    $ocorrencia = Ocorrencia::factory()->create([
        'subdisciplina_4_id' => $sub4->id,
        'subdisciplina_5_id' => $sub5->id,
        'subdisciplina_6_id' => $sub6->id,
    ]);

    Livewire::actingAs($this->admin)
        ->test(OcorrenciaModal::class)
        ->call('openEditModal', $ocorrencia->id)
        ->assertSet('form.subdisciplina4Id', $sub4->id)
        ->assertSet('form.subdisciplina5Id', $sub5->id)
        ->assertSet('form.subdisciplina6Id', $sub6->id)
        ->set('form.subdisciplina6Id', $novaSub6->id)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('ocorrencias', [
        'id' => $ocorrencia->id,
        'subdisciplina_4_id' => $sub4->id,
        'subdisciplina_5_id' => $sub5->id,
        'subdisciplina_6_id' => $novaSub6->id,
    ]);
});

test('disciplina principal não pode ser usada como subdisciplina 6', function (): void {
    $disciplina = Disciplina::factory()->create();

    Livewire::actingAs($this->admin)
        ->test(OcorrenciaModal::class)
        ->call('openCreateModal')
        ->set('form.titulo', 'Sub 6 inválida')
        ->set('form.status', OcorrenciaStatus::Aberto->value)
        ->set('form.abertura', '2026-06-01')
        ->set('form.agencia', 'Agência Central')
        ->set('form.subdisciplina6Id', $disciplina->id)
        ->call('save')
        ->assertHasErrors(['form.subdisciplina6Id']);
});
