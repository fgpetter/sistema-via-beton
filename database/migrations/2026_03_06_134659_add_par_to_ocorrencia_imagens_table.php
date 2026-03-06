<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ocorrencia_imagens', function (Blueprint $table) {
            $table->unsignedInteger('par')->default(1)->after('tipo');
        });

        $this->assignPairNumbers();
    }

    public function down(): void
    {
        Schema::table('ocorrencia_imagens', function (Blueprint $table) {
            $table->dropColumn('par');
        });
    }

    private function assignPairNumbers(): void
    {
        $grouped = DB::table('ocorrencia_imagens')
            ->orderBy('ocorrencia_id')
            ->orderBy('tipo')
            ->orderBy('id')
            ->get()
            ->groupBy('ocorrencia_id');

        foreach ($grouped as $ocorrenciaId => $imagens) {
            $antesCounter = 0;
            $depoisCounter = 0;

            foreach ($imagens as $imagem) {
                $par = match ($imagem->tipo) {
                    'antes' => ++$antesCounter,
                    'depois' => ++$depoisCounter,
                    default => 1,
                };

                DB::table('ocorrencia_imagens')
                    ->where('id', $imagem->id)
                    ->update(['par' => $par]);
            }
        }
    }
};
