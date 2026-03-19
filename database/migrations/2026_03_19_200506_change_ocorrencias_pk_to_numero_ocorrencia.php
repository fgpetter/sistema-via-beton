<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Fill NULL numero_ocorrencia with values based on old id
        DB::table('ocorrencias')
            ->whereNull('numero_ocorrencia')
            ->orWhere('numero_ocorrencia', 0)
            ->orderBy('id')
            ->each(function (object $row): void {
                DB::table('ocorrencias')
                    ->where('id', $row->id)
                    ->update(['numero_ocorrencia' => $row->id]);
            });

        // Add new FK column to ocorrencia_imagens
        Schema::table('ocorrencia_imagens', function (Blueprint $table) {
            $table->unsignedBigInteger('numero_ocorrencia')->after('id');
        });

        // Populate new FK from old relationship
        DB::statement(<<<'SQL'
            UPDATE ocorrencia_imagens
            SET numero_ocorrencia = (
                SELECT ocorrencias.numero_ocorrencia
                FROM ocorrencias
                WHERE ocorrencias.id = ocorrencia_imagens.ocorrencia_id
            )
        SQL);

        // Drop old FK constraint and column from ocorrencia_imagens
        Schema::table('ocorrencia_imagens', function (Blueprint $table) {
            $table->dropForeign(['ocorrencia_id']);
            $table->dropColumn('ocorrencia_id');
        });

        // Drop auto-increment PK from ocorrencias
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        // Make numero_ocorrencia the new PK
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->unsignedBigInteger('numero_ocorrencia')->nullable(false)->change();
            $table->primary('numero_ocorrencia');
        });

        // Add new FK constraint on ocorrencia_imagens
        Schema::table('ocorrencia_imagens', function (Blueprint $table) {
            $table->foreign('numero_ocorrencia')
                ->references('numero_ocorrencia')
                ->on('ocorrencias')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('ocorrencia_imagens', function (Blueprint $table) {
            $table->dropForeign(['numero_ocorrencia']);
        });

        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->dropPrimary(['numero_ocorrencia']);
        });

        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->id()->first();
            $table->unsignedBigInteger('numero_ocorrencia')->nullable()->change();
        });

        Schema::table('ocorrencia_imagens', function (Blueprint $table) {
            $table->foreignId('ocorrencia_id')->after('id')->constrained('ocorrencias')->onDelete('cascade');
        });

        Schema::table('ocorrencia_imagens', function (Blueprint $table) {
            $table->dropColumn('numero_ocorrencia');
        });
    }
};
