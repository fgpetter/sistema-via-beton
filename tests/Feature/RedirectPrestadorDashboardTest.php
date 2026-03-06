<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectPrestadorDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_prestador_is_redirected_from_dashboard_to_atendimentos(): void
    {
        $prestador = User::factory()->prestador()->create();

        $response = $this->actingAs($prestador)->get(route('painel.dashboard'));

        $response->assertRedirect(route('prestador.atendimentos'));
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get(route('painel.dashboard'));

        $response->assertOk();
    }

    public function test_unauthenticated_user_is_redirected_to_login(): void
    {
        $response = $this->get(route('painel.dashboard'));

        $response->assertRedirect('/login');
    }
}
