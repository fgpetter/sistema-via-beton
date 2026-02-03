<?php

namespace Database\Factories;

use App\Enums\TipoColaborador;
use App\Enums\TipoContrato;
use App\Models\Colaborador;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Colaborador>
 */
class ColaboradorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'tipo' => fake()->randomElement(TipoColaborador::cases()),
            'contrato' => fake()->randomElement(TipoContrato::cases()),
            'user_id' => User::factory()->prestador(),
        ];
    }
}
