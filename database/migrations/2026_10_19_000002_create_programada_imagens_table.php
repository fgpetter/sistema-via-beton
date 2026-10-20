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
        Schema::create('programada_imagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programada_id')->constrained('programadas')->onDelete('cascade');
            $table->string('path');
            $table->string('tipo');
            $table->unsignedInteger('par');
            $table->string('legenda')->nullable();
            $table->unique(['programada_id', 'tipo', 'par']);
            $table->index(['programada_id', 'par']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programada_imagens');
    }
};
