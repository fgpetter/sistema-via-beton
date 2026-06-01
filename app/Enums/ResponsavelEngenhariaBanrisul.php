<?php

namespace App\Enums;

enum ResponsavelEngenhariaBanrisul: string
{
    case DustinHofman = 'dustin_hofman';

    case IcaroDupont = 'icaro_dupont';

    case DustinHofmanIcaroDupont = 'dustin_hofman_icaro_dupont';

    public function label(): string
    {
        return match ($this) {
            self::DustinHofman => 'Dustin Hofman',
            self::IcaroDupont => 'Icaro Dupont',
            self::DustinHofmanIcaroDupont => 'Dustin Hofman / Icaro Dupont',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $responsavel) => [
            $responsavel->value => $responsavel->label(),
        ])->toArray();
    }
}
