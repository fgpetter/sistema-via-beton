<?php

namespace Tests\Feature\Admin;

use App\Enums\PreventivaStatus;
use App\Models\Preventiva;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DownloadRelatorioExecutivoPdfTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        Storage::fake('public');
    }

    public function test_admin_can_download_relatorio_executivo_pdf(): void
    {
        $preventiva = Preventiva::factory()->create([
            'status' => PreventivaStatus::Concluido,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.relatorio-executivo-pdf', $preventiva));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    public function test_relatorio_executivo_excludes_recusadas(): void
    {
        $preventiva = Preventiva::factory()->create([
            'status' => PreventivaStatus::Concluido,
        ]);
        $preventiva->imagens()->create(['path' => 'test/aceita.jpg', 'recusada' => false]);
        $preventiva->imagens()->create(['path' => 'test/recusada.jpg', 'recusada' => true]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.relatorio-executivo-pdf', $preventiva));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    public function test_relatorio_executivo_without_imagens_returns_pdf(): void
    {
        $preventiva = Preventiva::factory()->create([
            'status' => PreventivaStatus::Concluido,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.relatorio-executivo-pdf', $preventiva));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    public function test_non_admin_cannot_download_relatorio_executivo_pdf(): void
    {
        $prestador = User::factory()->prestador()->create();
        $preventiva = Preventiva::factory()->create([
            'status' => PreventivaStatus::Concluido,
        ]);

        $response = $this->actingAs($prestador)
            ->get(route('admin.preventivas.relatorio-executivo-pdf', $preventiva));

        $response->assertStatus(403);
    }

    public function test_guest_cannot_download_relatorio_executivo_pdf(): void
    {
        $preventiva = Preventiva::factory()->create([
            'status' => PreventivaStatus::Concluido,
        ]);

        $response = $this->get(route('admin.preventivas.relatorio-executivo-pdf', $preventiva));

        $response->assertRedirect(route('login'));
    }
}
