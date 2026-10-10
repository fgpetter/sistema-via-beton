<?php

namespace App\Enums;

use App\Contracts\ChecklistBlocoContract;
use App\Enums\Concerns\ChecklistBlocoConcern;

enum ChecklistCivilBloco: string implements ChecklistBlocoContract
{
    use ChecklistBlocoConcern;

    case ArquiteturaExterna = 'arquitetura_externa';
    case AcessibilidadeExterna = 'acessibilidade_externa';
    case Autoatendimento = 'autoatendimento';
    case Atendimento = 'atendimento';
    case Copa = 'copa';
    case ElevadoresEscadarias = 'elevadores_escadarias';
    case Cofre = 'cofre';
    case SanitarioFeminino = 'sanitario_feminino';
    case SanitarioMasculino = 'sanitario_masculino';
    case SanitarioPcd = 'sanitario_pcd';
    case Cobertura = 'cobertura';

    public function numero(): int
    {
        return match ($this) {
            self::ArquiteturaExterna => 1,
            self::AcessibilidadeExterna => 2,
            self::Autoatendimento => 3,
            self::Atendimento => 4,
            self::Copa => 5,
            self::ElevadoresEscadarias => 6,
            self::Cofre => 7,
            self::SanitarioFeminino => 8,
            self::SanitarioMasculino => 9,
            self::SanitarioPcd => 10,
            self::Cobertura => 11,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::ArquiteturaExterna => 'ARQUITETURA EXTERNA',
            self::AcessibilidadeExterna => 'ACESSIBILIDADE (EXTERNA)',
            self::Autoatendimento => 'AUTOATENDIMENTO',
            self::Atendimento => 'ATENDIMENTO',
            self::Copa => 'COPA',
            self::ElevadoresEscadarias => 'ELEVADORES E ESCADARIAS',
            self::Cofre => 'COFRE',
            self::SanitarioFeminino => 'SANITÁRIO FEMININO',
            self::SanitarioMasculino => 'SANITÁRIO MASCULINO',
            self::SanitarioPcd => 'SANITÁRIOS PCD',
            self::Cobertura => 'COBERTURA',
        };
    }

    /**
     * Grupo lateral do XLSX (faixa vertical do layout).
     */
    public function grupo(): string
    {
        return match ($this) {
            self::ArquiteturaExterna, self::AcessibilidadeExterna => 'FACHADA',
            self::Autoatendimento, self::Atendimento => 'ATENDIMENTO',
            self::Copa, self::ElevadoresEscadarias, self::Cofre => 'RETAGUARDA',
            self::SanitarioFeminino, self::SanitarioMasculino, self::SanitarioPcd => 'SANITÁRIOS',
            self::Cobertura => 'COBERTURA',
        };
    }

    /**
     * @return list<ChecklistCivilItem>
     */
    public function itens(): array
    {
        return collect(ChecklistCivilItem::cases())
            ->filter(fn (ChecklistCivilItem $item) => $item->bloco() === $this)
            ->values()
            ->all();
    }
}
