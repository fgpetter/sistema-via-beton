<?php

namespace Database\Seeders;

use App\Models\Colaborador;
use App\Models\Ocorrencia;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@vbeton.com.br',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            AdminColaboradorSeeder::class,
            PrazoSeeder::class,
        ]);

        $prestadores = User::factory()->prestador()->count(5)->create();
        $colaboradores = $prestadores->map(fn (User $prestador) => Colaborador::factory()->create([
            'user_id' => $prestador->id,
            'nome' => $prestador->name,
        ]));

        foreach ($colaboradores as $colaborador) {
            Ocorrencia::factory()->count(2)->create([
                'colaborador_id' => $colaborador->id,
            ]);
        }
    }
}
