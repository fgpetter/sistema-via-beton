<?php

namespace App\Contracts;

/**
 * Item de um checklist (civil ou elétrico). O código (ex.: "1.1") é a chave gravada no JSON.
 */
interface ChecklistItemContract extends \BackedEnum
{
    public function codigo(): string;

    public function label(): string;

    /**
     * Nome seguro para wire:model e regras de validação (sem ponto, que é separador de caminho).
     */
    public function formKey(): string;

    public function bloco(): ChecklistBlocoContract;
}
