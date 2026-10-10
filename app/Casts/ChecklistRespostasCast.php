<?php

namespace App\Casts;

use App\Enums\ChecklistResposta;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * Mapa código do item => resposta (ex.: {"1.1": "S"}), preservando as chaves.
 *
 * @implements CastsAttributes<array<string, ChecklistResposta>, iterable<string, ChecklistResposta|string>>
 */
class ChecklistRespostasCast implements CastsAttributes
{
    /**
     * @return array<string, ChecklistResposta>|null
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?array
    {
        if ($value === null) {
            return null;
        }

        $dados = is_string($value) ? json_decode($value, true) : $value;

        return collect($dados ?? [])
            ->map(fn (string $resposta) => ChecklistResposta::from($resposta))
            ->all();
    }

    /**
     * @param  iterable<string, ChecklistResposta|string>|null  $value
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if ($value === null) {
            return null;
        }

        $respostas = collect($value)
            ->map(fn (ChecklistResposta|string $resposta) => $resposta instanceof ChecklistResposta ? $resposta->value : $resposta)
            ->all();

        return json_encode($respostas, JSON_THROW_ON_ERROR);
    }
}
