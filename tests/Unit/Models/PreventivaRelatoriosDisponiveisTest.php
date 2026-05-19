<?php

namespace Tests\Unit\Models;

use App\Models\Preventiva;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PreventivaRelatoriosDisponiveisTest extends TestCase
{
    use RefreshDatabase;

    public function test_relatorios_disponiveis_when_descricao_and_imagem_exist(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição da preventiva',
        ]);
        $preventiva->imagens()->create(['path' => 'test/foto.jpg']);

        $this->assertTrue($preventiva->relatoriosDisponiveis());
    }

    public function test_relatorios_indisponiveis_without_descricao(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => null,
        ]);
        $preventiva->imagens()->create(['path' => 'test/foto.jpg']);

        $this->assertFalse($preventiva->relatoriosDisponiveis());
    }

    public function test_relatorios_indisponiveis_with_whitespace_only_descricao(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => '   ',
        ]);
        $preventiva->imagens()->create(['path' => 'test/foto.jpg']);

        $this->assertFalse($preventiva->relatoriosDisponiveis());
    }

    public function test_relatorios_indisponiveis_without_imagem(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição da preventiva',
        ]);

        $this->assertFalse($preventiva->relatoriosDisponiveis());
    }
}
