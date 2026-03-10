<?php

namespace App\Enums;

enum TipoEndereco: string
{
    case Agencia = 'agencia';

    public function label(): string
    {
        return match ($this) {
            self::Agencia => 'Agência',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $tipo) => [
            $tipo->value => $tipo->label(),
        ])->toArray();
    }
}
