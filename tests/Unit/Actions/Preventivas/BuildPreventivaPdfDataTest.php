<?php

namespace Tests\Unit\Actions\Preventivas;

use App\Actions\Preventivas\BuildRelatorioExecutivoPdfDataFromPreventiva;
use App\Actions\Preventivas\BuildVistoriaPdfDataFromPreventiva;
use App\Models\Preventiva;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BuildPreventivaPdfDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_vistoria_pdf_data_includes_descricao(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => '  Descrição da preventiva  ',
        ]);

        $dados = app(BuildVistoriaPdfDataFromPreventiva::class)($preventiva);

        $this->assertSame('Descrição da preventiva', $dados['descricao']);
    }

    public function test_relatorio_executivo_pdf_data_includes_descricao(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição executiva',
        ]);

        $dados = app(BuildRelatorioExecutivoPdfDataFromPreventiva::class)($preventiva);

        $this->assertSame('Descrição executiva', $dados['descricao']);
    }
}
