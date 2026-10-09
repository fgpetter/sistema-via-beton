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
            $table->foreignId('subdisciplina_4_id')->nullable()->after('subdisciplina_3_id')->constrained('disciplinas')->nullOnDelete();
            $table->foreignId('subdisciplina_5_id')->nullable()->after('subdisciplina_4_id')->constrained('disciplinas')->nullOnDelete();
            $table->foreignId('subdisciplina_6_id')->nullable()->after('subdisciplina_5_id')->constrained('disciplinas')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->dropForeign(['subdisciplina_4_id']);
            $table->dropForeign(['subdisciplina_5_id']);
            $table->dropForeign(['subdisciplina_6_id']);
            $table->dropColumn([
                'subdisciplina_4_id',
                'subdisciplina_5_id',
                'subdisciplina_6_id',
            ]);
        });
    }
};
