<?php

namespace Tests\Feature\Prestador;

use App\Actions\Ocorrencias\BuildRatPdfDataFromOcorrencia;
use App\Actions\Ocorrencias\RenderRatPdfFromOcorrencia;
use App\Enums\PrazoUnidade;
use App\Livewire\Prestador\AtendimentoDetalhe;
use App\Models\Colaborador;
use App\Models\Endereco;
use App\Models\Ocorrencia;
use App\Models\Prazo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EnviarRatTest extends TestCase
{
    use RefreshDatabase;

    public function test_rat_pdf_output_starts_with_pdf_magic_bytes(): void
    {
        $prestador = User::factory()->prestador()->create();
        $colaborador = Colaborador::factory()->create(['user_id' => $prestador->id, 'nome' => 'Prestador Teste']);
        $endereco = Endereco::factory()->create(['numero' => 112, 'endereco' => 'Rua Teste, 100']);
        $ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
            'colaborador_id' => $colaborador->id,
            'endereco_id' => $endereco->id,
            'agencia' => 'AG ACEGUA',
            'titulo' => 'Título do serviço',
            'descricao' => 'Descrição detalhada.',
        ]);

        $pdf = app(RenderRatPdfFromOcorrencia::class)($ocorrencia->fresh(['prazo', 'colaborador', 'enderecoVinculado']));

        $this->assertStringStartsWith('%PDF', $pdf);
        $this->assertGreaterThan(500, strlen($pdf));
    }

    public function test_prestador_cannot_enviar_rat_before_atendimento_iniciado(): void
    {
        $prestador = User::factory()->prestador()->create();
        $colaborador = Colaborador::factory()->create(['user_id' => $prestador->id]);
        $ocorrencia = Ocorrencia::factory()->aberto()->create([
            'colaborador_id' => $colaborador->id,
            'datahora_chegada' => null,
        ]);

        Livewire::actingAs($prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->set('emailRat', 'contato@agencia.com')
            ->call('enviarEmail')
            ->assertForbidden();
    }

    public function test_rat_pdf_emergencial_sim_when_prazo_emergencial(): void
    {
        $prestador = User::factory()->prestador()->create();
        $colaborador = Colaborador::factory()->create(['user_id' => $prestador->id]);
        $prazoEmergencial = Prazo::query()->firstOrCreate(
            ['nome' => Prazo::EMERGENCIAL],
            ['prazo_valor' => 6, 'prazo_unidade' => PrazoUnidade::Hora],
        );
        $ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
            'colaborador_id' => $colaborador->id,
            'prazo_id' => $prazoEmergencial->id,
        ]);

        $build = app(BuildRatPdfDataFromOcorrencia::class);
        $dados = $build($ocorrencia->fresh(['prazo', 'colaborador', 'enderecoVinculado']));

        $this->assertSame('Sim', $dados['emergencial']);
    }
}
