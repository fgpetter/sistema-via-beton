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
        Schema::create('ocorrencia_checklists_civil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->unique()->constrained('ocorrencias')->cascadeOnDelete();
            $table->json('arquitetura_externa');
            $table->json('acessibilidade_externa');
            $table->json('autoatendimento');
            $table->json('atendimento');
            $table->json('copa');
            $table->json('elevadores_escadarias');
            $table->json('cofre');
            $table->json('sanitario_feminino');
            $table->json('sanitario_masculino');
            $table->json('sanitario_pcd');
            $table->json('cobertura');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocorrencia_checklists_civil');
    }
};
