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
        $preventiva = $this->createPreventivaElegivel();

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.vistoria-pdf', $preventiva));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
        Storage::disk('public')->assertMissing('preventivas/'.$preventiva->id.'/vistoria/Vistoria-'.$preventiva->id.'.pdf');
    }

    public function test_vistoria_pdf_includes_all_imagens(): void
    {
        $preventiva = $this->createPreventivaElegivel();
        $preventiva->imagens()->create(['path' => 'test/foto2.jpg', 'recusada' => true]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.vistoria-pdf', $preventiva));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    public function test_vistoria_pdf_returns_404_without_descricao(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => null,
        ]);
        $preventiva->imagens()->create(['path' => 'test/foto.jpg']);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.vistoria-pdf', $preventiva));

        $response->assertStatus(404);
    }

    public function test_vistoria_pdf_returns_404_without_imagem(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição da preventiva',
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.vistoria-pdf', $preventiva));

        $response->assertStatus(404);
    }

    public function test_vistoria_pdf_regenerates_on_each_request(): void
    {
        $preventiva = $this->createPreventivaElegivel();

        $this->actingAs($this->admin)
            ->get(route('admin.preventivas.vistoria-pdf', $preventiva))
            ->assertStatus(200);

        $this->actingAs($this->admin)
            ->get(route('admin.preventivas.vistoria-pdf', $preventiva))
            ->assertStatus(200);
    }

    public function test_non_admin_cannot_download_vistoria_pdf(): void
    {
        $prestador = User::factory()->prestador()->create();
        $preventiva = $this->createPreventivaElegivel();

        $response = $this->actingAs($prestador)
            ->get(route('admin.preventivas.vistoria-pdf', $preventiva));

        $response->assertStatus(403);
    }

    public function test_guest_cannot_download_vistoria_pdf(): void
    {
        $preventiva = $this->createPreventivaElegivel();

        $response = $this->get(route('admin.preventivas.vistoria-pdf', $preventiva));

        $response->assertRedirect(route('login'));
    }

    private function createPreventivaElegivel(): Preventiva
    {
        $preventiva = Preventiva::factory()->create([
            'status' => PreventivaStatus::Aberto,
            'descricao' => 'Descrição da preventiva',
        ]);
        $preventiva->imagens()->create(['path' => 'test/foto.jpg']);

        return $preventiva;
    }
}
