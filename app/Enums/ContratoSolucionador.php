<?php

namespace App\Enums;

enum ContratoSolucionador: string
{
    case ViaBetonSuregFronteira = '0100557/2025';

    public function label(): string
    {
        return match ($this) {
            self::ViaBetonSuregFronteira => 'VIA BETON - Sureg Fronteira',
        };
    }

    /**
     * Resolve o número do contrato a partir do nome do Grupo Solucionador do Excel.
     */
    public static function fromGrupoSolucionador(string $grupo): ?self
    {
        return match (mb_strtolower(trim($grupo))) {
            'via beton - sureg fronteira' => self::ViaBetonSuregFronteira,
            default => null,
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $contrato) => [$contrato->value => $contrato->label()])
            ->toArray();
    }
}
