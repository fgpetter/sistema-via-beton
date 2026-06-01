<?php

namespace Database\Factories;

use App\Models\Disciplina;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Disciplina>
 */
class DisciplinaFactory extends Factory
{
    protected $model = Disciplina::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'disciplina' => fake()->unique()->words(2, true),
            'subdisciplina' => false,
        ];
    }

    public function subdisciplina(): static
    {
        return $this->state(fn (array $attributes) => [
            'subdisciplina' => true,
        ]);
    }
}
