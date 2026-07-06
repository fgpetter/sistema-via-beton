<?php

namespace Tests\Unit\Views;

use Tests\TestCase;

class PreventivaRelatorioMedicaoPdfViewTest extends TestCase
{
    public function test_renders_titulo_and_metadados(): void
    {
        $html = view('pdf.preventiva-relatorio-medicao', [
            'dados' => $this->dadosMinimos(),
        ])->render();

        $this->assertStringContainsString('RELATÓRIO DE MEDIÇÃO', $html);
        $this->assertStringContainsString('Descrição', $html);
        $this->assertStringContainsString('Texto da descrição da preventiva', $html);
        $this->assertStringContainsString('FOTOGRAFIAS', $html);
    }

    public function test_renders_antes_depois_layout(): void
    {
        $html = view('pdf.preventiva-relatorio-medicao', [
            'dados' => $this->dadosMinimos(),
        ])->render();

        $this->assertStringContainsString('IMAGEM ANTES', $html);
        $this->assertStringContainsString('IMAGEM DEPOIS', $html);
        $this->assertStringContainsString('Legenda antes', $html);
        $this->assertStringContainsString('data:image/jpeg;base64,/9j/4AAQ', $html);
        $this->assertStringContainsString('max-height: 130px', $html);
        $this->assertStringContainsString('foto-area', $html);
    }

    public function test_renders_empty_depois_cells_without_placeholder(): void
    {
        $dados = $this->dadosMinimos();
        $dados['pares'] = [
            [
                'antes' => ['src' => 'data:image/jpeg;base64,/9j/4AAQ', 'legenda' => ''],
                'depois' => [],
            ],
        ];

        $html = view('pdf.preventiva-relatorio-medicao', ['dados' => $dados])->render();

        $this->assertStringContainsString('IMAGEM ANTES', $html);
        $this->assertStringContainsString('IMAGEM DEPOIS', $html);
        $this->assertStringNotContainsString('placeholder', strtolower($html));
    }

    public function test_renders_multiple_depois_in_rows_of_three(): void
    {
        $dados = $this->dadosMinimos();
        $dados['pares'] = [
            [
                'antes' => ['src' => 'data:image/jpeg;base64,/9j/antes', 'legenda' => ''],
                'depois' => [
                    ['src' => 'data:image/jpeg;base64,/9j/depois1'],
                    ['src' => 'data:image/jpeg;base64,/9j/depois2'],
                    ['src' => 'data:image/jpeg;base64,/9j/depois3'],
                    ['src' => 'data:image/jpeg;base64,/9j/depois4'],
                ],
            ],
        ];

        $html = view('pdf.preventiva-relatorio-medicao', ['dados' => $dados])->render();

        $this->assertStringContainsString('/9j/depois1', $html);
        $this->assertStringContainsString('/9j/depois4', $html);
        $this->assertEquals(6, substr_count($html, 'IMAGEM DEPOIS'));
    }

    /**
     * @return array<string, mixed>
     */
    private function dadosMinimos(): array
    {
        return [
            'titulo_relatorio' => 'RELATÓRIO DE MEDIÇÃO',
            'numero_preventiva' => '1',
            'numero_contrato' => 'CT-001',
            'responsavel_engenharia_banrisul' => '',
            'codigo_nome_local' => '100 - Agência Centro',
            'endereco' => 'Rua Exemplo, 123',
            'descricao' => 'Texto da descrição da preventiva',
            'pares' => [
                [
                    'antes' => [
                        'src' => 'data:image/jpeg;base64,/9j/4AAQ',
                        'legenda' => 'Legenda antes',
                    ],
                    'depois' => [
                        ['src' => 'data:image/jpeg;base64,/9j/depois1'],
                        ['src' => 'data:image/jpeg;base64,/9j/depois2'],
                    ],
                ],
            ],
        ];
    }
}
