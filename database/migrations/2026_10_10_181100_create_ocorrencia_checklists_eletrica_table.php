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
        Schema::create('ocorrencia_checklists_eletrica', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->unique()->constrained('ocorrencias')->cascadeOnDelete();
            $table->json('itens_gerais');
            $table->json('entrada_telecom');
            $table->json('infraestrutura_externa');
            $table->json('sala_autoatendimento');
            $table->json('caixas');
            $table->json('no_break');
            $table->json('atendimento');
            $table->json('sala_automacao');
            $table->json('sala_cofre_antessala');
            $table->json('banheiros');
            $table->json('quadros_eletricos');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocorrencia_checklists_eletrica');
    }
};
