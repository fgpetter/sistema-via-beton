<?php

namespace App\Enums;

use App\Enums\UserRole;

enum TipoColaborador: string
{
    case Levantadores = 'levantadores';
    case Projetistas = 'projetistas';
    case Orcamentistas = 'orcamentistas';
    case Coordenadores = 'coordenadores';
    case Administrativos = 'administrativos';

    public function label(): string
    {
        return match ($this) {
            self::Levantadores => 'Levantadores',
            self::Projetistas => 'Projetistas',
            self::Orcamentistas => 'Orçamentistas',
            self::Coordenadores => 'Coordenadores',
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
            self::Levantadores => UserRole::Prestador,
            self::Projetistas => UserRole::Prestador,
            self::Orcamentistas => UserRole::Prestador,
            self::Coordenadores => UserRole::Coordenador,
            self::Administrativos => UserRole::Admin,
        };
    }
}
