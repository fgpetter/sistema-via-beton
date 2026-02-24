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
        Schema::create('ocorrencia_imagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->constrained('ocorrencias')->onDelete('cascade');
            $table->string('tipo');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocorrencia_imagens');
    }
};
