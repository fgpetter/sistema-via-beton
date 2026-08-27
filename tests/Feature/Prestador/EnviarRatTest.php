<?php

namespace Tests\Feature\Prestador;

use App\Actions\Ocorrencias\BuildRatPdfDataFromOcorrencia;
use App\Actions\Ocorrencias\RenderRatPdfFromOcorrencia;
use App\Enums\PrazoUnidade;
use App\Enums\TipoColaborador;
use App\Livewire\Prestador\AtendimentoDetalhe;
use App\Models\Colaborador;
use App\Models\Disciplina;
use App\Models\Endereco;
use App\Models\Ocorrencia;
use App\Models\Prazo;
use App\Models\ResponsavelEngenharia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
            'data_chegada' => null,
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

    public function test_rat_pdf_data_saida_usa_registro_da_ocorrencia(): void
    {
        $prestador = User::factory()->prestador()->create();
        $colaborador = Colaborador::factory()->create(['user_id' => $prestador->id]);
        $ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
            'colaborador_id' => $colaborador->id,
            'data_chegada' => '2026-03-28',
            'data_saida' => '2026-03-28',
        ]);

        $build = app(BuildRatPdfDataFromOcorrencia::class);
        $dados = $build($ocorrencia->fresh(['prazo', 'colaborador', 'enderecoVinculado']));

        $this->assertSame('28/03/2026', $dados['data_chegada']);
        $this->assertSame('28/03/2026', $dados['data_saida']);
    }

    public function test_reenvio_rat_nao_sobrescreve_data_saida(): void
    {
        $prestador = User::factory()->prestador()->create();
        $colaborador = Colaborador::factory()->create(['user_id' => $prestador->id]);
        $ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
            'colaborador_id' => $colaborador->id,
            'data_saida' => '2026-03-10',
            'email_rat_enviado' => now()->subDay(),
        ]);

        Mail::fake();
        Storage::fake('public');

        Livewire::actingAs($prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->set('emailRat', 'contato@agencia.com')
            ->call('enviarEmail')
            ->assertHasNoErrors();

        $ocorrencia->refresh();
        $this->assertEquals('2026-03-10', $ocorrencia->data_saida->toDateString());
    }

    public function test_primeiro_envio_rat_nao_sobrescreve_data_saida_preenchida(): void
    {
        $prestador = User::factory()->prestador()->create();
        $colaborador = Colaborador::factory()->create(['user_id' => $prestador->id]);
        $ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
            'colaborador_id' => $colaborador->id,
            'data_saida' => '2026-03-10',
            'email_rat_enviado' => null,
        ]);

        Mail::fake();
        Storage::fake('public');

        Livewire::actingAs($prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->set('emailRat', 'contato@agencia.com')
            ->call('enviarEmail')
            ->assertHasNoErrors();

        $ocorrencia->refresh();
        $this->assertEquals('2026-03-10', $ocorrencia->data_saida->toDateString());
        $this->assertNotNull($ocorrencia->email_rat_enviado);
    }

    public function test_rat_pdf_exibe_labels_chegada_e_saida_com_datas(): void
    {
        $dados = BuildRatPdfDataFromOcorrencia::mockForPreview();
        $html = view('pdf.rat', ['dados' => $dados])->render();

        $this->assertStringContainsString('CHEGADA', $html);
        $this->assertStringContainsString('SAÍDA', $html);
        $this->assertStringContainsString('20/03/2026', $html);
        $this->assertStringNotContainsString('Data e hora CHEGADA', $html);
        $this->assertStringNotContainsString('Data e hora SAÍDA', $html);
    }

    public function test_rat_pdf_nao_exibe_coluna_prazo_de_atendimento_no_rodape(): void
    {
        $dados = BuildRatPdfDataFromOcorrencia::mockForPreview();
        $html = view('pdf.rat', ['dados' => $dados])->render();

        $this->assertArrayNotHasKey('prazo_atendimento_rodape', $dados);
        $this->assertSame(1, substr_count($html, 'Prazo de Atendimento'));
        $this->assertDoesNotMatchRegularExpression(
            '/SAÍDA<\/td>\s*<td class="lbl">Prazo de Atendimento/',
            $html,
        );
    }

    public function test_rat_com_administrativo_e_nome_prestador_usa_prestador_nome(): void
    {
        $admin = User::factory()->admin()->create();
        $colaborador = Colaborador::factory()->create([
            'user_id' => $admin->id,
            'tipo' => TipoColaborador::Administrativos,
            'nome' => 'Maria Admin',
        ]);
        $ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
            'colaborador_id' => $colaborador->id,
            'prestador_nome' => 'Carlos Adriano Vidal',
        ]);

        $dados = app(BuildRatPdfDataFromOcorrencia::class)(
            $ocorrencia->fresh(['colaborador'])
        );

        $this->assertSame('Carlos Adriano Vidal', $dados['identificacao_representante']);
    }

    public function test_rat_com_administrativo_sem_nome_prestador_usa_nome_do_colaborador(): void
    {
        $admin = User::factory()->admin()->create();
        $colaborador = Colaborador::factory()->create([
            'user_id' => $admin->id,
            'tipo' => TipoColaborador::Administrativos,
            'nome' => 'Maria Admin',
        ]);
        $ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
            'colaborador_id' => $colaborador->id,
            'prestador_nome' => null,
        ]);

        $dados = app(BuildRatPdfDataFromOcorrencia::class)(
            $ocorrencia->fresh(['colaborador'])
        );

        $this->assertSame('Maria Admin', $dados['identificacao_representante']);
    }

    public function test_rat_com_prestador_ignora_prestador_nome_residual(): void
    {
        $prestador = User::factory()->prestador()->create();
        $colaborador = Colaborador::factory()->create([
            'user_id' => $prestador->id,
            'tipo' => TipoColaborador::Prestadores,
            'nome' => 'João Prestador',
        ]);
        $ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
            'colaborador_id' => $colaborador->id,
            'prestador_nome' => 'Carlos Residual',
        ]);

        $dados = app(BuildRatPdfDataFromOcorrencia::class)(
            $ocorrencia->fresh(['colaborador'])
        );

        $this->assertSame('João Prestador', $dados['identificacao_representante']);
    }
}
