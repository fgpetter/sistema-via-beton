<?php

namespace App\Actions;

use App\Enums\TipoColaborador;
use App\Enums\TipoContrato;
use App\Models\Colaborador;
use App\Models\User;
use App\Notifications\SendPasswordResetNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateOrUpdateColaborador
{
    public function create(
        string $nome,
        string $email,
        TipoColaborador $tipo,
        TipoContrato $contrato
    ): Colaborador {
        return DB::transaction(function () use ($nome, $email, $tipo, $contrato) {
            $userRole = $tipo->toUserRole();

            $user = User::create([
                'name' => $nome,
                'email' => $email,
                'password' => Hash::make(Str::random(8)),
                'role' => $userRole,
            ]);

            $colaborador = Colaborador::create([
                'nome' => $nome,
                'tipo' => $tipo,
                'contrato' => $contrato,
                'user_id' => $user->id,
            ]);

            $user->notify(new SendPasswordResetNotification());

            return $colaborador;
        });
    }

    public function update(
        Colaborador $colaborador,
        string $nome,
        TipoColaborador $tipo,
        TipoContrato $contrato,
        int $userId
    ): Colaborador {
        return DB::transaction(function () use ($colaborador, $nome, $tipo, $contrato, $userId) {
            $colaborador->update([
                'nome' => $nome,
                'tipo' => $tipo,
                'contrato' => $contrato,
                'user_id' => $userId,
            ]);

            $user = $colaborador->user;
            if ($user) {
                $userRole = $tipo->toUserRole();
                $updateData = ['name' => $nome];

                if ($user->role !== $userRole) {
                    $updateData['role'] = $userRole;
                }

                $user->update($updateData);
            }

            return $colaborador->fresh();
        });
    }
}
