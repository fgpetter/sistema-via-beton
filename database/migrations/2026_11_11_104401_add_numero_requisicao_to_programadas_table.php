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
        Schema::table('programadas', function (Blueprint $table) {
            $table->string('numero_requisicao')->nullable()->after('prestador_nome');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programadas', function (Blueprint $table) {
            $table->dropColumn('numero_requisicao');
        });
    }
};
