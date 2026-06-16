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
            $table->string('responsavel_engenharia_banrisul')->nullable()->after('contrato');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preventivas', function (Blueprint $table) {
            $table->dropColumn('responsavel_engenharia_banrisul');
        });
    }
};
