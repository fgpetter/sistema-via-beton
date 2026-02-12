<?php

namespace App\Enums;

enum TipoColaborador: string
{
    case Prestadores = 'prestadores';
    case Administrativos = 'administrativos';

    public function label(): string
    {
        return match ($this) {
            self::Prestadores => 'Prestadores',
            self::Administrativos => 'Administrativos',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $tipo) => [
            $tipo->value => $tipo->label(),
        ])->toArray();
    }

    public function toUserRole(): UserRole
    {
        return match ($this) {
            self::Prestadores => UserRole::Prestador,
            self::Administrativos => UserRole::Admin,
        };
    }
}
