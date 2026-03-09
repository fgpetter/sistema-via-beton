<?php

use App\Enums\TipoEndereco;
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
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->string('tipo')->default(TipoEndereco::Agencia->value);
            $table->string('numero')->nullable();
            $table->string('horario')->nullable();
            $table->string('endereco')->nullable();
            $table->string('cidade_estado')->nullable();
            $table->string('fone')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
