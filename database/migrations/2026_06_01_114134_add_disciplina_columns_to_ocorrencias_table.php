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
            $table->foreignId('disciplina_id')->nullable()->after('prazo_id')->constrained('disciplinas')->nullOnDelete();
            $table->foreignId('subdisciplina_1_id')->nullable()->after('disciplina_id')->constrained('disciplinas')->nullOnDelete();
            $table->foreignId('subdisciplina_2_id')->nullable()->after('subdisciplina_1_id')->constrained('disciplinas')->nullOnDelete();
            $table->foreignId('subdisciplina_3_id')->nullable()->after('subdisciplina_2_id')->constrained('disciplinas')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->dropForeign(['disciplina_id']);
            $table->dropForeign(['subdisciplina_1_id']);
            $table->dropForeign(['subdisciplina_2_id']);
            $table->dropForeign(['subdisciplina_3_id']);
            $table->dropColumn([
                'disciplina_id',
                'subdisciplina_1_id',
                'subdisciplina_2_id',
                'subdisciplina_3_id',
            ]);
        });
    }
};
