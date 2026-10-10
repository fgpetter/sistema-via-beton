<?php

namespace App\Models\Concerns;

use App\Casts\ChecklistRespostasCast;
use App\Contracts\ChecklistBlocoContract;
use App\Enums\TipoChecklist;

/**
 * Colunas JSON por bloco e casts comuns aos models de checklist (civil e elétrico).
 */
trait HasChecklistRespostas
{
    /**
     * @return list<string>
     */
    public function getFillable(): array
    {
        return [
            'ocorrencia_id',
            'observacoes',
            ...array_map(fn (ChecklistBlocoContract $bloco) => $bloco->value, static::tipo()->blocos()),
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        $casts = [];

        foreach (static::tipo()->blocos() as $bloco) {
            $casts[$bloco->value] = ChecklistRespostasCast::class;
        }

        return $casts;
    }

    abstract public static function tipo(): TipoChecklist;
}
