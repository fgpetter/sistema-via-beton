<?php

namespace App\Enums;

enum PrazoUnidade: string
{
    case Hora = 'hora';
    case Dia = 'dia';

    public function label(int $valor): string
    {
        return match ($this) {
            self::Hora => $valor === 1 ? 'hora' : 'horas',
            self::Dia => $valor === 1 ? 'dia corrido' : 'dias corridos',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $unidade) => [
            $unidade->value => match ($unidade) {
                self::Hora => 'Hora(s)',
                self::Dia => 'Dia(s) corrido(s)',
            },
        ])->toArray();
    }
}
