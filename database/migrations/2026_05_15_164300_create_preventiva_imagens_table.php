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
        Schema::create('preventiva_imagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('preventiva_id')->constrained('preventivas')->onDelete('cascade');
            $table->string('path');
            $table->string('legenda')->nullable();
            $table->boolean('recusada')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preventiva_imagens');
    }
};
