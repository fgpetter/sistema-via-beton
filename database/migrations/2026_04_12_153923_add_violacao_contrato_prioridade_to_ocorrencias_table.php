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
            $table->dateTime('violacao_projetada')->nullable()->after('abertura');
            $table->string('contrato')->nullable()->after('violacao_projetada');
            $table->string('prioridade')->nullable()->after('contrato');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->dropColumn(['violacao_projetada', 'contrato', 'prioridade']);
        });
    }
};
