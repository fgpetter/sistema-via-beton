<?php

use App\Enums\TipoColaborador;
use App\Enums\TipoContrato;
use App\Enums\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $adminUsers = DB::table('users')
            ->where('role', UserRole::Admin->value)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('colaboradores')
                    ->whereColumn('colaboradores.user_id', 'users.id');
            })
            ->get();

        foreach ($adminUsers as $user) {
            DB::table('colaboradores')->insert([
                'nome' => $user->name,
                'tipo' => TipoColaborador::Administrativos->value,
                'contrato' => TipoContrato::CLT->value,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('colaboradores')
            ->where('tipo', TipoColaborador::Administrativos->value)
            ->whereIn('user_id', function ($query) {
                $query->select('id')
                    ->from('users')
                    ->where('role', UserRole::Admin->value);
            })
            ->delete();
    }
};
