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
        Schema::table('preventivas', function (Blueprint $table) {
            $table->dropColumn(['violacao_projetada', 'prioridade']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preventivas', function (Blueprint $table) {
            $table->text('violacao_projetada')->nullable()->after('datahora_saida');
            $table->text('prioridade')->nullable()->after('contrato');
        });
    }
};
