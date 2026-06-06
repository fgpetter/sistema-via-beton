<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('preventiva_imagens', function (Blueprint $table) {
            $table->unsignedInteger('position')->nullable()->after('recusada');
        });

        $preventivaIds = DB::table('preventiva_imagens')
            ->distinct()
            ->pluck('preventiva_id');

        foreach ($preventivaIds as $preventivaId) {
            $imagemIds = DB::table('preventiva_imagens')
                ->where('preventiva_id', $preventivaId)
                ->orderBy('created_at')
                ->orderBy('id')
                ->pluck('id');

            foreach ($imagemIds as $index => $imagemId) {
                DB::table('preventiva_imagens')
                    ->where('id', $imagemId)
                    ->update(['position' => $index + 1]);
            }
        }

        Schema::table('preventiva_imagens', function (Blueprint $table) {
            $table->unsignedInteger('position')->nullable(false)->change();
            $table->index(['preventiva_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preventiva_imagens', function (Blueprint $table) {
            $table->dropIndex(['preventiva_id', 'position']);
            $table->dropColumn('position');
        });
    }
};
