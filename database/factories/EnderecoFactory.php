<?php

namespace Database\Factories;

use App\Enums\TipoEndereco;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endereco>
 */
class EnderecoFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => 'AG '.$this->faker->unique()->city(),
            'tipo' => TipoEndereco::Agencia,
            'numero' => (string) $this->faker->numberBetween(1, 200),
            'horario' => '08:00 às 17:00',
            'endereco' => $this->faker->streetAddress(),
            'cidade_estado' => $this->faker->city().'/'.$this->faker->stateAbbr(),
            'fone' => $this->faker->phoneNumber(),
            'ativo' => true,
        ];
    }

    public function inativo(): static
    {
        return $this->state(fn () => ['ativo' => false]);
    }
}
