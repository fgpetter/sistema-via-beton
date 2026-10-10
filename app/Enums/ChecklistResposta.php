<?php

namespace App\Enums;

enum ChecklistResposta: string
{
    case Sim = 'S';
    case Nao = 'N';
    case NaoAplica = 'NA';

    public function label(): string
    {
        return match ($this) {
            self::Sim => 'Sim',
            self::Nao => 'Não',
            self::NaoAplica => 'Não aplica',
        };
    }

    public function sigla(): string
    {
        return match ($this) {
            self::Sim => 'S',
            self::Nao => 'N',
            self::NaoAplica => 'N/A',
        };
    }
}
