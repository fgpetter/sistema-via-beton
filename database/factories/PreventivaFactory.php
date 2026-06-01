<?php

namespace Database\Factories;

use App\Enums\PreventivaStatus;
use App\Models\Colaborador;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Preventiva>
 */
class PreventivaFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(PreventivaStatus::cases()),
            'titulo' => fake()->sentence(4),
            'descricao' => fake()->optional()->paragraph(),
            'abertura' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'colaborador_id' => Colaborador::factory(),
            'agencia' => fake()->company(),
            'endereco' => fake()->optional()->address(),
            'datahora_chegada' => fake()->optional(0.4)->dateTimeBetween('-3 months', 'now'),
            'datahora_saida' => fake()->optional(0.3)->dateTimeBetween('-3 months', 'now'),
            'comentarios' => fake()->optional()->paragraph(),
        ];
    }

    public function aberto(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PreventivaStatus::Aberto,
        ]);
    }

    public function concluida(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PreventivaStatus::Concluido,
        ]);
    }
}
