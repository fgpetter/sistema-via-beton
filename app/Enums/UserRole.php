<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Prestador = 'prestador';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Prestador => 'Prestador',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Admin => 'warning',
            self::Prestador => 'success',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $role) => [
            $role->value => $role->label(),
        ])->toArray();
    }
}
