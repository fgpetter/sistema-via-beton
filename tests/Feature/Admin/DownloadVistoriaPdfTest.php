<?php

namespace Tests\Feature\Admin;

use App\Enums\PreventivaStatus;
use App\Models\Preventiva;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DownloadVistoriaPdfTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        Storage::fake('public');
    }

    public function test_admin_can_download_vistoria_pdf(): void
    {
        $preventiva = Preventiva::factory()->create([
            'status' => PreventivaStatus::Concluido,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.vistoria-pdf', $preventiva));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    public function test_vistoria_pdf_includes_all_imagens(): void
    {
        $preventiva = Preventiva::factory()->create([
            'status' => PreventivaStatus::Concluido,
        ]);
        $preventiva->imagens()->create(['path' => 'test/foto1.jpg']);
        $preventiva->imagens()->create(['path' => 'test/foto2.jpg', 'recusada' => true]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.vistoria-pdf', $preventiva));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    public function test_non_admin_cannot_download_vistoria_pdf(): void
    {
        $prestador = User::factory()->prestador()->create();
        $preventiva = Preventiva::factory()->create([
            'status' => PreventivaStatus::Concluido,
        ]);

        $response = $this->actingAs($prestador)
            ->get(route('admin.preventivas.vistoria-pdf', $preventiva));

        $response->assertStatus(403);
    }

    public function test_guest_cannot_download_vistoria_pdf(): void
    {
        $preventiva = Preventiva::factory()->create([
            'status' => PreventivaStatus::Concluido,
        ]);

        $response = $this->get(route('admin.preventivas.vistoria-pdf', $preventiva));

        $response->assertRedirect(route('login'));
    }
}
