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
        Schema::create('preventiva_medicao_imagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('preventiva_imagem_id')->constrained('preventiva_imagens')->cascadeOnDelete();
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preventiva_medicao_imagens');
    }
};
