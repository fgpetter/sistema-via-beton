<?php

namespace App\Enums;

enum PrazoNome: string
{
    case Emergencial = 'Engenharia.Emergencial';
    case Inspecao = 'Engenharia.Inspeção';
    case VistoriaConfeccao = 'Engenharia.Vistoria e confecção';
    case ValidacaoOrcamento = 'Engenharia.Validação de orçamento';
    case ManutencaoCorretiva = 'Engenharia.Manutenção Corretiva';
    case AdequacaoEspacosFisicos = 'Engenharia.Adequação de espaços físicos';

    public function label(): string
    {
        $parts = explode('.', $this->value, 2);

        return $parts[1] ?? $this->value;
    }

    public static function labelFor(?string $nome): string
    {
        if ($nome === null || $nome === '') {
            return '—';
        }

        $enum = self::tryFrom($nome);

        return $enum?->label() ?? $nome;
    }
}
