<?php

namespace App\Enums\Concerns;

/**
 * Comportamento comum aos enums de item. Cada enum define bloco() e label().
 */
trait ChecklistItemConcern
{
    /**
     * Código gravado no JSON (ex.: "1.1"), que também identifica o bloco.
     */
    public function codigo(): string
    {
        return $this->value;
    }

    /**
     * Nome seguro para wire:model e regras de validação (sem ponto, que é separador de caminho).
     */
    public function formKey(): string
    {
        return str_replace('.', '_', $this->value);
    }
}
