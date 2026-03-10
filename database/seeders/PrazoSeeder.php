<?php

namespace Database\Seeders;

use App\Enums\PrazoUnidade;
use App\Models\Prazo;
use Illuminate\Database\Seeder;

class PrazoSeeder extends Seeder
{
    public function run(): void
    {
        $timestamp = now();

        Prazo::upsert([
            [
                'nome' => 'Engenharia.Emergencial',
                'prazo_valor' => 6,
                'prazo_unidade' => PrazoUnidade::Hora->value,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'nome' => 'Engenharia.Inspeção',
                'prazo_valor' => 5,
                'prazo_unidade' => PrazoUnidade::Dia->value,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'nome' => 'Engenharia.Vistoria e confecção',
                'prazo_valor' => 5,
                'prazo_unidade' => PrazoUnidade::Dia->value,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'nome' => 'Engenharia.Validação de orçamento',
                'prazo_valor' => 5,
                'prazo_unidade' => PrazoUnidade::Dia->value,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'nome' => 'Engenharia.Manutenção Corretiva',
                'prazo_valor' => 20,
                'prazo_unidade' => PrazoUnidade::Dia->value,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'nome' => 'Engenharia.Adequação de espaços físicos',
                'prazo_valor' => 60,
                'prazo_unidade' => PrazoUnidade::Dia->value,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ], ['nome'], ['prazo_valor', 'prazo_unidade', 'updated_at']);
    }
}
