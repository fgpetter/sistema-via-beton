<?php

use App\Enums\PrazoUnidade;
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
        Schema::create('prazos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->unsignedInteger('prazo_valor');
            $table->string('prazo_unidade')->default(PrazoUnidade::Dia->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prazos');
    }
};
