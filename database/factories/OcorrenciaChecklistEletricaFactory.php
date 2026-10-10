<?php

namespace Database\Factories;

use App\Contracts\ChecklistItemContract;
use App\Enums\ChecklistResposta;
use App\Enums\TipoChecklist;
use App\Models\Ocorrencia;
use App\Models\OcorrenciaChecklistEletrica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OcorrenciaChecklistEletrica>
 */
class OcorrenciaChecklistEletricaFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ocorrencia_id' => Ocorrencia::factory(),
            'observacoes' => fake()->optional()->sentence(),
            ...$this->respostasPara(fn () => ChecklistResposta::Sim),
        ];
    }

    public function respostasMistas(): static
    {
        return $this->state(fn (array $attributes) => $this->respostasPara(
            fn () => fake()->randomElement(ChecklistResposta::cases()),
        ));
    }

    /**
     * @param  callable(): ChecklistResposta  $resposta
     * @return array<string, array<string, ChecklistResposta>>
     */
    protected function respostasPara(callable $resposta): array
    {
        $respostas = [];

        foreach (TipoChecklist::Eletrica->blocos() as $bloco) {
            $respostas[$bloco->value] = collect($bloco->itens())
                ->mapWithKeys(fn (ChecklistItemContract $item) => [$item->codigo() => $resposta()])
                ->all();
        }

        return $respostas;
    }
}
