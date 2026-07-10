<?php

namespace Tests\Unit\Actions\Ocorrencias;

use App\Actions\Ocorrencias\BuildRelatorioAtendimentoPdfDataFromOcorrencia;
use App\Enums\ResponsavelEngenhariaBanrisul;
use App\Models\Ocorrencia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BuildRelatorioAtendimentoPdfDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_relatorio_atendimento_pdf_data_inclui_responsavel_engenharia_banrisul(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'responsavel_engenharia_banrisul' => ResponsavelEngenhariaBanrisul::DustinHofmanIcaroDupont,
        ]);

        $dados = app(BuildRelatorioAtendimentoPdfDataFromOcorrencia::class)($ocorrencia);

        $this->assertSame('Dustin Hofman / Icaro Dupont', $dados['responsavel_engenharia_banrisul']);
    }

    public function test_relatorio_atendimento_pdf_data_retorna_vazio_quando_responsavel_nao_informado(): void
    {
        $ocorrencia = Ocorrencia::factory()->create([
            'responsavel_engenharia_banrisul' => null,
        ]);

        $dados = app(BuildRelatorioAtendimentoPdfDataFromOcorrencia::class)($ocorrencia);

        $this->assertSame('', $dados['responsavel_engenharia_banrisul']);
    }
}
