<?php

namespace App\Enums;

enum TipoEndereco: string
{
    case AGENCIA = 'AGENCIA';
    case DATAC = 'DATAC';
    case DG = 'DG';
    case EMPRESAS = 'EMPRESAS';
    case PA = 'PA';
    case PA_PM = 'PA PM';
    case PAE = 'PAE';
    case SUREG = 'SUREG';

    public function label(): string
    {
        return match ($this) {
            self::AGENCIA => 'AGENCIA',
            self::DATAC => 'DATAC',
            self::DG => 'DG',
            self::EMPRESAS => 'EMPRESAS',
            self::PA => 'PA',
            self::PA_PM => 'PA PM',
            self::PAE => 'PAE',
            self::SUREG => 'SUREG',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $tipo) => [
            $tipo->value => $tipo->label(),
        ])->toArray();
    }
}
