<?php

namespace Tests\Unit\Models;

use App\Models\Preventiva;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PreventivaRelatorioMedicaoDisponivelTest extends TestCase
{
    use RefreshDatabase;

    public function test_relatorio_medicao_disponivel_when_par_completo_exists(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição da preventiva',
        ]);
        $imagem = $preventiva->imagens()->create(['path' => 'test/foto.jpg', 'recusada' => false, 'position' => 1]);
        $imagem->medicaoImagens()->create(['path' => 'test/medicao.jpg']);

        $this->assertTrue($preventiva->relatorioMedicaoDisponivel());
    }

    public function test_relatorio_medicao_indisponivel_without_medicao_imagens(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição da preventiva',
        ]);
        $preventiva->imagens()->create(['path' => 'test/foto.jpg', 'recusada' => false, 'position' => 1]);

        $this->assertFalse($preventiva->relatorioMedicaoDisponivel());
    }

    public function test_relatorio_medicao_indisponivel_without_descricao(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => null,
        ]);
        $imagem = $preventiva->imagens()->create(['path' => 'test/foto.jpg', 'recusada' => false, 'position' => 1]);
        $imagem->medicaoImagens()->create(['path' => 'test/medicao.jpg']);

        $this->assertFalse($preventiva->relatorioMedicaoDisponivel());
    }

    public function test_relatorio_medicao_indisponivel_when_only_recusada_has_medicao(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição da preventiva',
        ]);
        $preventiva->imagens()->create(['path' => 'test/aceita.jpg', 'recusada' => false, 'position' => 1]);

        $recusada = $preventiva->imagens()->create(['path' => 'test/recusada.jpg', 'recusada' => true, 'position' => 2]);
        $recusada->medicaoImagens()->create(['path' => 'test/medicao.jpg']);

        $this->assertFalse($preventiva->relatorioMedicaoDisponivel());
    }

    public function test_relatorio_medicao_indisponivel_without_imagem(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição da preventiva',
        ]);

        $this->assertFalse($preventiva->relatorioMedicaoDisponivel());
    }
}
