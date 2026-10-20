<?php

namespace App\Enums;

enum ProgramadaStatus: string
{
    case Aberto = 'aberto';

    case Espera = 'espera';

    case Andamento = 'andamento';

    case Revisar = 'revisar';

    case Concluido = 'concluido';

    public function label(): string
    {
        return match ($this) {
            self::Aberto => 'Aberto',
            self::Espera => 'Em Espera',
            self::Andamento => 'Em Andamento',
            self::Revisar => 'Revisar',
            self::Concluido => 'Concluído',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Aberto => 'danger',
            self::Espera => 'info',
            self::Andamento => 'warning',
            self::Revisar => 'info',
            self::Concluido => 'success',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $status) => [
            $status->value => $status->label(),
        ])->toArray();
    }
}
