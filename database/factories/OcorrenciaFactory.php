<?php

namespace Database\Factories;

use App\Enums\OcorrenciaStatus;
use App\Models\Colaborador;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ocorrencia>
 */
class OcorrenciaFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(OcorrenciaStatus::cases()),
            'titulo' => fake()->sentence(4),
            'descricao' => fake()->optional()->paragraph(),
            'abertura' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'colaborador_id' => Colaborador::factory(),
            'agencia' => fake()->company(),
            'endereco' => fake()->optional()->address(),
            'email_enviado' => fake()->optional(0.3)->dateTimeBetween('-3 months', 'now'),
            'email_rat' => fake()->optional(0.3)->safeEmail(),
            'comentarios' => fake()->optional()->paragraph(),
        ];
    }

    public function emAndamento(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => OcorrenciaStatus::Andamento,
        ]);
    }

    public function concluida(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => OcorrenciaStatus::Concluido,
        ]);
    }
}
