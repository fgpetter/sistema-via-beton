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
            PrazoSeeder::class,
        ]);
    }
}
