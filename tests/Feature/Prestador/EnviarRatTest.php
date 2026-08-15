<?php

namespace Tests\Feature\Prestador;

use App\Actions\Ocorrencias\BuildRatPdfDataFromOcorrencia;
use App\Actions\Ocorrencias\RenderRatPdfFromOcorrencia;
use App\Enums\PrazoUnidade;
use App\Livewire\Prestador\AtendimentoDetalhe;
use App\Models\Colaborador;
use App\Models\Disciplina;
use App\Models\Endereco;
use App\Models\Ocorrencia;
use App\Models\Prazo;
use App\Models\ResponsavelEngenharia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
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

    public function test_rat_pdf_data_inclui_disciplina_e_subdisciplinas(): void
    {
        $prestador = User::factory()->prestador()->create();
        $colaborador = Colaborador::factory()->create(['user_id' => $prestador->id]);
        $disciplina = Disciplina::factory()->create(['disciplina' => 'Elétrica']);
        $sub1 = Disciplina::factory()->subdisciplina()->create(['disciplina' => 'Tomada']);
        $sub2 = Disciplina::factory()->subdisciplina()->create(['disciplina' => 'Interruptor']);
        $ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
            'colaborador_id' => $colaborador->id,
            'disciplina_id' => $disciplina->id,
            'subdisciplina_1_id' => $sub1->id,
            'subdisciplina_2_id' => $sub2->id,
        ]);

        $dados = app(BuildRatPdfDataFromOcorrencia::class)(
            $ocorrencia->fresh([
                'prazo',
                'colaborador',
                'enderecoVinculado',
                'disciplina',
                'subdisciplina1',
                'subdisciplina2',
                'subdisciplina3',
            ])
        );

        $this->assertSame('Elétrica', $dados['disciplina']);
        $this->assertSame('Tomada', $dados['subdisciplina_1']);
        $this->assertSame('Interruptor', $dados['subdisciplina_2']);
        $this->assertSame('', $dados['subdisciplina_3']);
    }

    public function test_rat_pdf_data_inclui_responsavel_engenharia_banrisul(): void
    {
        $prestador = User::factory()->prestador()->create();
        $colaborador = Colaborador::factory()->create(['user_id' => $prestador->id]);
        $ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
            'colaborador_id' => $colaborador->id,
            'responsavel_engenharia_id' => ResponsavelEngenharia::query()
                ->where('nome', 'Dustin Hofman / Icaro Dupont')
                ->value('id'),
        ]);

        $dados = app(BuildRatPdfDataFromOcorrencia::class)(
            $ocorrencia->fresh(['prazo', 'colaborador', 'enderecoVinculado'])
        );

        $this->assertSame('Dustin Hofman / Icaro Dupont', $dados['responsavel_engenharia_banrisul']);
    }

    public function test_rat_pdf_datahora_saida_usa_registro_da_ocorrencia_e_fuso_configurado(): void
    {
        config(['app.timezone' => 'America/Sao_Paulo']);

        $prestador = User::factory()->prestador()->create();
        $colaborador = Colaborador::factory()->create(['user_id' => $prestador->id]);
        $saida = Carbon::parse('2026-03-28 16:30:59', 'America/Sao_Paulo');
        $ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
            'colaborador_id' => $colaborador->id,
            'datahora_saida' => $saida,
        ]);

        $geradoEmUtc = Carbon::parse('2026-03-28 19:31:00', 'UTC');
        $build = app(BuildRatPdfDataFromOcorrencia::class);
        $dados = $build($ocorrencia->fresh(['prazo', 'colaborador', 'enderecoVinculado']), $geradoEmUtc);

        $this->assertSame('28/03/2026 - 16:30', $dados['datahora_saida']);
    }

    public function test_rat_pdf_nao_exibe_coluna_prazo_de_atendimento_no_rodape(): void
    {
        $dados = BuildRatPdfDataFromOcorrencia::mockForPreview();
        $html = view('pdf.rat', ['dados' => $dados])->render();

        $this->assertArrayNotHasKey('prazo_atendimento_rodape', $dados);
        $this->assertSame(1, substr_count($html, 'Prazo de Atendimento'));
        $this->assertDoesNotMatchRegularExpression(
            '/Data e hora SAÍDA<\/td>\s*<td class="lbl">Prazo de Atendimento/',
            $html,
        );
    }
}
