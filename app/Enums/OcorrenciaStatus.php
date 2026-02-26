<?php

namespace App\Enums;

enum OcorrenciaStatus: string
{
    case Aberto = 'aberto';
    case Andamento = 'andamento';
    case Revisar = 'revisar';
    case Concluido = 'concluido';

    public function label(): string
    {
        return match ($this) {
            self::Aberto => 'Aberto',
            self::Andamento => 'Em Andamento',
            self::Revisar => 'Revisar',
            self::Concluido => 'Concluído',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Aberto => 'danger',
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
