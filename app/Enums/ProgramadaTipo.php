<?php

namespace App\Enums;

enum ProgramadaTipo: string
{
    case Corretiva = 'corretiva';
    case CemMaisCem = '100_100';

    public function label(): string
    {
        return match ($this) {
            self::Corretiva => 'Programada Corretiva',
            self::CemMaisCem => 'Programada 100+100',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $tipo) => [$tipo->value => $tipo->label()])->all();
    }
}
