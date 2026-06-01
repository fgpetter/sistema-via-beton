<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AuthSwalToastTest extends TestCase
{
    use RefreshDatabase;

    public function test_invalid_login_shows_error_swal_toast_on_login_page(): void
    {
        $this->from('/login')
            ->post('/login', [
                'email' => 'inexistente@example.com',
                'password' => 'senha-invalida',
            ]);

        $response = $this->get('/login');

        $response->assertOk();
        $response->assertSee('Swal.fire', false);
        $response->assertSee('"icon":"error"', false);
        $response->assertSee('"toast":true', false);
    }

    public function test_forgot_password_success_shows_success_swal_toast(): void
    {
        Notification::fake();

        $user = User::factory()->create(['email' => 'usuario@example.com']);

        $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        $response = $this->get('/forgot-password');

        $response->assertOk();
        $response->assertSee('Swal.fire', false);
        $response->assertSee('"icon":"success"', false);
        $response->assertSee('"toast":true', false);
    }
}
