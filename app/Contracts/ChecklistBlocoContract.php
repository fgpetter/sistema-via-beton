<?php

namespace App\Contracts;

/**
 * Bloco de um checklist (civil ou elétrico), usado pelo modal, pelo form e pelo PDF.
 */
interface ChecklistBlocoContract extends \BackedEnum
{
    public function numero(): int;

    public function codigo(): string;

    public function label(): string;

    /**
     * Grupo lateral do layout. Null quando o checklist não tem coluna de grupo.
     */
    public function grupo(): ?string;

    /**
     * @return list<ChecklistItemContract>
     */
    public function itens(): array;

    /**
     * @return list<string>
     */
    public function formKeys(): array;
}
