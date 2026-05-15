<?php

namespace App\Enums;

enum PreventivaStatus: string
{
    case Aberto = 'aberto';

    case Aprovado = 'aprovado';

    case Reprovado = 'reprovado';

    case Concluido = 'concluido';

    public function label(): string
    {
        return match ($this) {
            self::Aberto => 'Aberto',
            self::Aprovado => 'Aprovado',
            self::Reprovado => 'Reprovado',
            self::Concluido => 'Concluído',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Aberto => 'danger',
            self::Aprovado => 'warning',
            self::Reprovado => 'danger',
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
