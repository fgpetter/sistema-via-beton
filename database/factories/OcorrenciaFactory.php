<?php

namespace Database\Factories;

use App\Enums\OcorrenciaStatus;
use App\Enums\PrazoUnidade;
use App\Models\Colaborador;
use App\Models\Prazo;
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
            'numero_ocorrencia' => fake()->unique()->numberBetween(10000, 99999),
            'status' => fake()->randomElement(OcorrenciaStatus::cases()),
            'titulo' => fake()->sentence(4),
            'descricao' => fake()->optional()->paragraph(),
            'abertura' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'colaborador_id' => Colaborador::factory(),
            'prazo_id' => (Prazo::query()->inRandomOrder()->first()
                ?? Prazo::firstOrCreate(
                    ['nome' => Prazo::EMERGENCIAL],
                    ['prazo_valor' => 6, 'prazo_unidade' => PrazoUnidade::Hora->value]
                ))->id,
            'agencia' => fake()->company(),
            'endereco' => fake()->optional()->address(),
            'email_enviado' => fake()->optional(0.3)->dateTimeBetween('-3 months', 'now'),
            'email_rat' => fake()->optional(0.3)->safeEmail(),
            'datahora_chegada' => fake()->optional(0.4)->dateTimeBetween('-3 months', 'now'),
            'datahora_saida' => fake()->optional(0.3)->dateTimeBetween('-3 months', 'now'),
            'comentarios' => fake()->optional()->paragraph(),
        ];
    }

    public function aberto(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => OcorrenciaStatus::Aberto,
        ]);
    }

    public function emAndamento(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => OcorrenciaStatus::Andamento,
        ]);
    }

    public function emAtendimentoIniciado(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => OcorrenciaStatus::Andamento,
            'datahora_chegada' => now(),
        ]);
    }

    public function revisar(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => OcorrenciaStatus::Revisar,
            'datahora_chegada' => now()->subHours(2),
            'datahora_saida' => now(),
        ]);
    }

    public function concluida(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => OcorrenciaStatus::Concluido,
        ]);
    }

    public function emergencial(): static
    {
        return $this->state(fn (array $attributes) => [
            'prazo_id' => Prazo::query()->where('nome', Prazo::EMERGENCIAL)->first()?->id
                ?? Prazo::firstOrCreate(
                    ['nome' => Prazo::EMERGENCIAL],
                    ['prazo_valor' => 6, 'prazo_unidade' => PrazoUnidade::Hora->value]
                )->id,
        ]);
    }
}
