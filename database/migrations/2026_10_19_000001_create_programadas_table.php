<?php

use App\Enums\ProgramadaStatus;
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
        Schema::create('programadas', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default(ProgramadaStatus::Aberto->value);
            $table->string('tipo');
            $table->string('titulo', 255);
            $table->text('descricao')->nullable();
            $table->date('abertura');
            $table->foreignId('colaborador_id')->nullable()->constrained('colaboradores')->onDelete('set null');
            $table->string('agencia', 255);
            $table->text('comentarios')->nullable();
            $table->text('comentarios_prestador')->nullable();
            $table->date('data_chegada')->nullable();
            $table->date('data_saida')->nullable();
            $table->string('prestador_nome')->nullable();
            $table->string('email_rat')->nullable();
            $table->dateTime('email_rat_enviado')->nullable();
            $table->string('rat_pdf_path')->nullable();
            $table->text('contrato')->nullable();
            $table->foreignId('endereco_id')->nullable()->constrained('enderecos')->onDelete('set null');
            $table->string('endereco')->nullable();
            $table->foreignId('responsavel_engenharia_id')->nullable()->constrained('responsavel_engenharia')->restrictOnDelete();
            $table->foreignId('disciplina_id')->nullable()->constrained('disciplinas')->nullOnDelete();
            foreach (range(1, 6) as $numero) {
                $table->foreignId("subdisciplina_{$numero}_id")->nullable()->constrained('disciplinas')->nullOnDelete();
            }
            $table->foreignId('concluido_por')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programadas');
    }
};
