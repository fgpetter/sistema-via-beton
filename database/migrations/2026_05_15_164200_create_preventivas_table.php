<?php

use App\Enums\PreventivaStatus;
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
        Schema::create('preventivas', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default(PreventivaStatus::Aberto->value);
            $table->string('titulo', 255);
            $table->text('descricao')->nullable();
            $table->date('abertura');
            $table->foreignId('colaborador_id')->nullable()->constrained('colaboradores')->onDelete('set null');
            $table->string('agencia', 255);
            $table->text('comentarios')->nullable();
            $table->dateTime('datahora_chegada')->nullable();
            $table->dateTime('datahora_saida')->nullable();
            $table->text('violacao_projetada')->nullable();
            $table->text('contrato')->nullable();
            $table->text('prioridade')->nullable();
            $table->foreignId('endereco_id')->nullable()->constrained('enderecos')->onDelete('set null');
            $table->string('endereco')->nullable();
            $table->foreignId('concluido_por')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preventivas');
    }
};
