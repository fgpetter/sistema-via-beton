<?php

namespace Tests\Feature\Database;

use App\Enums\PrazoUnidade;
use App\Enums\TipoColaborador;
use App\Enums\TipoContrato;
use App\Models\Colaborador;
use App\Models\Prazo;
use App\Models\User;
use Database\Seeders\AdminColaboradorSeeder;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\PrazoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeedersTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_populates_default_prazos_and_admin_colaborador(): void
    {
        $this->seed(DatabaseSeeder::class);

        $admin = User::where('email', 'admin@vbeton.com.br')->firstOrFail();

        $this->assertDatabaseHas('colaboradores', [
            'user_id' => $admin->id,
            'nome' => 'Admin',
            'tipo' => TipoColaborador::Administrativos->value,
            'contrato' => TipoContrato::CLT->value,
        ]);

        $this->assertSame(6, Prazo::count());
        $this->assertDatabaseHas('prazos', [
            'nome' => 'Engenharia.Emergencial',
            'prazo_valor' => 6,
            'prazo_unidade' => PrazoUnidade::Hora->value,
        ]);
    }

    public function test_seeders_are_idempotent_for_default_prazos_and_admin_colaboradores(): void
    {
        $adminWithColaborador = User::factory()->admin()->create();
        $adminWithoutColaborador = User::factory()->admin()->create();

        Colaborador::factory()->create([
            'nome' => $adminWithColaborador->name,
            'tipo' => TipoColaborador::Administrativos,
            'contrato' => TipoContrato::CLT,
            'user_id' => $adminWithColaborador->id,
        ]);

        $this->seed([
            AdminColaboradorSeeder::class,
            PrazoSeeder::class,
        ]);

        $this->seed([
            AdminColaboradorSeeder::class,
            PrazoSeeder::class,
        ]);

        $this->assertSame(2, Colaborador::query()->whereIn('user_id', [
            $adminWithColaborador->id,
            $adminWithoutColaborador->id,
        ])->count());

        $this->assertSame(6, Prazo::count());
    }
}
