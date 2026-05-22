<?php

namespace Tests\Unit\Views;

use Tests\TestCase;

class PreventivaRelatorioPdfViewTest extends TestCase
{
    public function test_renders_descricao_full_width_before_fotografias(): void
    {
        $html = view('pdf.preventiva-relatorio', [
            'dados' => $this->dadosMinimos(),
        ])->render();

        $this->assertStringContainsString('Descrição', $html);
        $this->assertStringContainsString('Texto da descrição da preventiva', $html);
        $this->assertStringContainsString('class="val descricao-val" colspan="3"', $html);
        $this->assertStringContainsString('class="lbl" colspan="3">Descrição</td>', $html);

        $posDescricao = strpos($html, 'Texto da descrição da preventiva');
        $posFotografias = strpos($html, 'FOTOGRAFIAS');
        $this->assertNotFalse($posDescricao);
        $this->assertNotFalse($posFotografias);
        $this->assertLessThan($posFotografias, $posDescricao);
    }

    /**
     * @return array<string, mixed>
     */
    private function dadosMinimos(): array
    {
        return [
            'titulo_relatorio' => 'RELATÓRIO TÉCNICO FOTOGRÁFICO',
            'numero_preventiva' => '1',
            'numero_contrato' => 'CT-001',
            'responsavel_engenharia_banrisul' => '',
            'codigo_nome_local' => '100 - Agência Centro',
            'endereco' => 'Rua Exemplo, 123',
            'descricao' => 'Texto da descrição da preventiva',
            'imagens' => [
                [
                    'src' => 'data:image/jpeg;base64,/9j/4AAQ',
                    'legenda' => 'Foto 1',
                    'recusada' => false,
                ],
            ],
            'incluirRecusadas' => false,
        ];
    }
}
