<?php

namespace App\Enums;

enum TipoImagemOcorrencia: string
{
    case Antes = 'antes';
    case Depois = 'depois';

    public function label(): string
    {
        return match ($this) {
            self::Antes => 'Antes',
            self::Depois => 'Depois',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $tipo) => [
            $tipo->value => $tipo->label(),
        ])->toArray();
    }
}
