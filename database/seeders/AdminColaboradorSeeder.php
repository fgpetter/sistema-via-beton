<?php

namespace Database\Seeders;

use App\Enums\TipoColaborador;
use App\Enums\TipoContrato;
use App\Models\Colaborador;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminColaboradorSeeder extends Seeder
{
    public function run(): void
    {
        User::admins()
            ->doesntHave('colaborador')
            ->get(['id', 'name'])
            ->each(function (User $user): void {
                Colaborador::create([
                    'nome' => $user->name,
                    'tipo' => TipoColaborador::Administrativos,
                    'contrato' => TipoContrato::CLT,
                    'user_id' => $user->id,
                ]);
            });
    }
}
