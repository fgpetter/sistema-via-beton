<?php

use App\Enums\PrazoUnidade;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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

        DB::table('prazos')->insert([
            [
                'nome' => 'Engenharia.Emergencial',
                'prazo_valor' => 6,
                'prazo_unidade' => PrazoUnidade::Hora->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Engenharia.Inspeção',
                'prazo_valor' => 5,
                'prazo_unidade' => PrazoUnidade::Dia->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Engenharia.Vistoria e confecção',
                'prazo_valor' => 5,
                'prazo_unidade' => PrazoUnidade::Dia->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Engenharia.Validação de orçamento',
                'prazo_valor' => 5,
                'prazo_unidade' => PrazoUnidade::Dia->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Engenharia.Manutenção Corretiva',
                'prazo_valor' => 20,
                'prazo_unidade' => PrazoUnidade::Dia->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Engenharia.Adequação de espaços físicos',
                'prazo_valor' => 60,
                'prazo_unidade' => PrazoUnidade::Dia->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prazos');
    }
};
