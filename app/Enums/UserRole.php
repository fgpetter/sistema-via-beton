<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';
    case Coordenador = 'coordenador';
    case Prestador = 'prestador';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::Admin => 'Admin',
            self::Coordenador => 'Coordenador',
            self::Prestador => 'Prestador',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SuperAdmin => 'danger',
            self::Admin => 'warning',
            self::Coordenador => 'primary',
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
