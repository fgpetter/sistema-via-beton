<?php

namespace App\Enums;

use App\Contracts\ChecklistBlocoContract;
use App\Enums\Concerns\ChecklistBlocoConcern;

enum ChecklistEletricaBloco: string implements ChecklistBlocoContract
{
    use ChecklistBlocoConcern;

    case ItensGerais = 'itens_gerais';
    case EntradaTelecom = 'entrada_telecom';
    case InfraestruturaExterna = 'infraestrutura_externa';
    case SalaAutoatendimento = 'sala_autoatendimento';
    case Caixas = 'caixas';
    case NoBreak = 'no_break';
    case Atendimento = 'atendimento';
    case SalaAutomacao = 'sala_automacao';
    case SalaCofreAntessala = 'sala_cofre_antessala';
    case Banheiros = 'banheiros';
    case QuadrosEletricos = 'quadros_eletricos';

    public function numero(): int
    {
        return match ($this) {
            self::ItensGerais => 1,
            self::EntradaTelecom => 2,
            self::InfraestruturaExterna => 3,
            self::SalaAutoatendimento => 4,
            self::Caixas => 5,
            self::NoBreak => 6,
            self::Atendimento => 7,
            self::SalaAutomacao => 8,
            self::SalaCofreAntessala => 9,
            self::Banheiros => 10,
            self::QuadrosEletricos => 11,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::ItensGerais => 'ITENS GERAIS',
            self::EntradaTelecom => 'ENTRADA DE TELECOM',
            self::InfraestruturaExterna => 'INFRAESTRUTURA EXTERNA',
            self::SalaAutoatendimento => 'SALA DE AUTOATENDIMENTO',
            self::Caixas => 'CAIXAS',
            self::NoBreak => 'NO BREAK',
            self::Atendimento => 'ATENDIMENTO',
            self::SalaAutomacao => 'SALA DE AUTOMAÇÃO',
            self::SalaCofreAntessala => 'SALA COFRE E ANTESSALA',
            self::Banheiros => 'BANHEIROS',
            self::QuadrosEletricos => 'QUADROS ELÉTRICOS - QGBT, CD1, CD ESTAB., CDBK, CDAR',
        };
    }

    /**
     * O checklist elétrico não tem coluna lateral de grupo.
     */
    public function grupo(): ?string
    {
        return null;
    }

    /**
     * @return list<ChecklistEletricaItem>
     */
    public function itens(): array
    {
        return collect(ChecklistEletricaItem::cases())
            ->filter(fn (ChecklistEletricaItem $item) => $item->bloco() === $this)
            ->values()
            ->all();
    }
}
