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
            $table->renameColumn('datahora_chegada', 'data_chegada');
            $table->renameColumn('datahora_saida', 'data_saida');
        });

        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->date('data_chegada')->nullable()->change();
            $table->date('data_saida')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->dateTime('data_chegada')->nullable()->change();
            $table->dateTime('data_saida')->nullable()->change();
        });

        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->renameColumn('data_chegada', 'datahora_chegada');
            $table->renameColumn('data_saida', 'datahora_saida');
        });
    }
};
