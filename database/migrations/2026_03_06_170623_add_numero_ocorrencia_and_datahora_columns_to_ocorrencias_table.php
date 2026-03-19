<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->unsignedBigInteger('numero_ocorrencia')->nullable()->after('id');
            $table->dateTime('datahora_chegada')->nullable()->after('email_rat_enviado');
            $table->dateTime('datahora_saida')->nullable()->after('datahora_chegada');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->dropColumn(['numero_ocorrencia', 'datahora_chegada', 'datahora_saida']);
        });
    }
};
