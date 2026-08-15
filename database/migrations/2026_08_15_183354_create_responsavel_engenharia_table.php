<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @var array<string, string>
     */
    private array $catalogo = [
        'dustin_hofman' => 'Dustin Hofman',
        'icaro_dupont' => 'Icaro Dupont',
        'dustin_hofman_icaro_dupont' => 'Dustin Hofman / Icaro Dupont',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('responsavel_engenharia', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        $now = now();
        $ids = [];

        foreach ($this->catalogo as $valorEnum => $nome) {
            $ids[$valorEnum] = DB::table('responsavel_engenharia')->insertGetId([
                'nome' => $nome,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->foreignId('responsavel_engenharia_id')
                ->nullable()
                ->after('prazo_id')
                ->constrained('responsavel_engenharia')
                ->restrictOnDelete();
        });

        Schema::table('preventivas', function (Blueprint $table) {
            $table->foreignId('responsavel_engenharia_id')
                ->nullable()
                ->after('contrato')
                ->constrained('responsavel_engenharia')
                ->restrictOnDelete();
        });

        foreach ($ids as $valorEnum => $id) {
            DB::table('ocorrencias')
                ->where('responsavel_engenharia_banrisul', $valorEnum)
                ->update(['responsavel_engenharia_id' => $id]);

            DB::table('preventivas')
                ->where('responsavel_engenharia_banrisul', $valorEnum)
                ->update(['responsavel_engenharia_id' => $id]);
        }

        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->dropColumn('responsavel_engenharia_banrisul');
        });

        Schema::table('preventivas', function (Blueprint $table) {
            $table->dropColumn('responsavel_engenharia_banrisul');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->string('responsavel_engenharia_banrisul')->nullable()->after('prazo_id');
        });

        Schema::table('preventivas', function (Blueprint $table) {
            $table->string('responsavel_engenharia_banrisul')->nullable()->after('contrato');
        });

        foreach ($this->catalogo as $valorEnum => $nome) {
            $id = DB::table('responsavel_engenharia')->where('nome', $nome)->value('id');

            if ($id === null) {
                continue;
            }

            DB::table('ocorrencias')
                ->where('responsavel_engenharia_id', $id)
                ->update(['responsavel_engenharia_banrisul' => $valorEnum]);

            DB::table('preventivas')
                ->where('responsavel_engenharia_id', $id)
                ->update(['responsavel_engenharia_banrisul' => $valorEnum]);
        }

        Schema::table('ocorrencias', function (Blueprint $table) {
            $table->dropConstrainedForeignId('responsavel_engenharia_id');
        });

        Schema::table('preventivas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('responsavel_engenharia_id');
        });

        Schema::dropIfExists('responsavel_engenharia');
    }
};
