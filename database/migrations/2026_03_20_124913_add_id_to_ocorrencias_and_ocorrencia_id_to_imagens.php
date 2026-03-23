<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('ocorrencias', 'id')) {
            Schema::table('ocorrencias', function (Blueprint $table) {
                $table->id()->first();
            });
        }

        if (! Schema::hasColumn('ocorrencia_imagens', 'ocorrencia_id')) {
            Schema::table('ocorrencia_imagens', function (Blueprint $table) {
                $table->foreignId('ocorrencia_id')->after('id')->constrained('ocorrencias')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('ocorrencia_imagens', 'ocorrencia_id')) {
            Schema::table('ocorrencia_imagens', function (Blueprint $table) {
                $table->dropForeign(['ocorrencia_id']);
                $table->dropColumn('ocorrencia_id');
            });
        }
    }
};
