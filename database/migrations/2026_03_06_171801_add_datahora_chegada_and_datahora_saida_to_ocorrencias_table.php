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
            if (! Schema::hasColumn('ocorrencias', 'datahora_chegada')) {
                $table->dateTime('datahora_chegada')->nullable()->after('email_rat_enviado');
            }
            if (! Schema::hasColumn('ocorrencias', 'datahora_saida')) {
                $table->dateTime('datahora_saida')->nullable()->after('datahora_chegada');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->dropColumn(['datahora_chegada', 'datahora_saida']);
        });
    }
};
