<?php

use App\Actions\Ocorrencias\BuildRatPdfDataFromOcorrencia;
use App\Models\Colaborador;
use App\Models\Disciplina;
use App\Models\Ocorrencia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('dados da RAT incluem subdisciplinas 4, 5 e 6', function (): void {
    $prestador = User::factory()->prestador()->create();
    $colaborador = Colaborador::factory()->create(['user_id' => $prestador->id]);
    $sub4 = Disciplina::factory()->subdisciplina()->create(['disciplina' => 'Torneira']);
    $sub5 = Disciplina::factory()->subdisciplina()->create(['disciplina' => 'Válvula']);
    $sub6 = Disciplina::factory()->subdisciplina()->create(['disciplina' => 'Registro']);
    $ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
        'colaborador_id' => $colaborador->id,
        'subdisciplina_4_id' => $sub4->id,
        'subdisciplina_5_id' => $sub5->id,
        'subdisciplina_6_id' => $sub6->id,
    ]);

    $dados = app(BuildRatPdfDataFromOcorrencia::class)(
        $ocorrencia->fresh(['prazo', 'colaborador', 'enderecoVinculado'])
    );

    $this->assertSame('Torneira', $dados['subdisciplina_4']);
    $this->assertSame('Válvula', $dados['subdisciplina_5']);
    $this->assertSame('Registro', $dados['subdisciplina_6']);
});
