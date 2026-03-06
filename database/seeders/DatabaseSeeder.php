<?php

namespace Database\Seeders;

use App\Models\Colaborador;
use App\Models\Endereco;
use App\Models\Ocorrencia;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@vbeton.com.br',
        ]);

        // Prestadores com Colaboradores
        $prestadores = User::factory()->prestador()->count(5)->create();
        $colaboradores = [];
        foreach ($prestadores as $prestador) {
            $colaboradores[] = Colaborador::factory()->create([
                'user_id' => $prestador->id,
                'nome' => $prestador->name,
            ]);
        }

        // Endereços
        Endereco::factory()->count(10)->create();

        // Ocorrências
        foreach ($colaboradores as $colaborador) {
            Ocorrencia::factory()->count(2)->create([
                'colaborador_id' => $colaborador->id,
            ]);
        }
    }
}
