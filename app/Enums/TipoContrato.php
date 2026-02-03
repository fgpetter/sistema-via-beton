<?php

namespace App\Enums;

enum TipoContrato: string
{
    case CLT = 'clt';
    case PJ = 'pj';

    public function label(): string
    {
        return match ($this) {
            self::CLT => 'CLT',
            self::PJ => 'PJ',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $contrato) => [
            $contrato->value => $contrato->label(),
        ])->toArray();
    }
}
