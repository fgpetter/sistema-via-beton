<?php

namespace App\Enums\Concerns;

use App\Contracts\ChecklistItemContract;

/**
 * Comportamento comum aos enums de bloco. Cada enum define numero(), label(), grupo() e itens().
 */
trait ChecklistBlocoConcern
{
    public function codigo(): string
    {
        return $this->numero().'.0';
    }

    /**
     * @return list<string>
     */
    public function formKeys(): array
    {
        return array_map(fn (ChecklistItemContract $item) => $item->formKey(), $this->itens());
    }

    public static function porNumero(int $numero): ?self
    {
        return collect(self::cases())->first(fn (self $bloco) => $bloco->numero() === $numero);
    }
}
