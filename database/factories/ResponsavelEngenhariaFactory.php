<?php

namespace Database\Factories;

use App\Models\ResponsavelEngenharia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ResponsavelEngenharia>
 */
class ResponsavelEngenhariaFactory extends Factory
{
    protected $model = ResponsavelEngenharia::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->unique()->words(3, true),
        ];
    }
}
