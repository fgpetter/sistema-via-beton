<?php

namespace Database\Factories;

use App\Enums\PrazoUnidade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prazo>
 */
class PrazoFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => 'Engenharia.'.$this->faker->unique()->words(2, true),
            'prazo_valor' => fake()->numberBetween(1, 90),
            'prazo_unidade' => fake()->randomElement(PrazoUnidade::cases()),
        ];
    }
}
