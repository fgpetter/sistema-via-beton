<?php

namespace Tests\Feature\Admin;

use App\Enums\PreventivaStatus;
use App\Models\Preventiva;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DownloadRelatorioMedicaoPdfTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        Storage::fake('public');
    }

    public function test_admin_can_download_relatorio_medicao_pdf(): void
    {
        $preventiva = $this->createPreventivaElegivel();

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.relatorio-medicao-pdf', $preventiva));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
        Storage::disk('public')->assertMissing('preventivas/'.$preventiva->id.'/medicao/RelatorioMedicao-'.$preventiva->id.'.pdf');
    }

    public function test_relatorio_medicao_regenerates_on_each_request(): void
    {
        $preventiva = $this->createPreventivaElegivel();

        $this->actingAs($this->admin)
            ->get(route('admin.preventivas.relatorio-medicao-pdf', $preventiva))
            ->assertStatus(200);

        $this->actingAs($this->admin)
            ->get(route('admin.preventivas.relatorio-medicao-pdf', $preventiva))
            ->assertStatus(200);
    }

    public function test_relatorio_medicao_returns_404_without_medicao_imagens(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição da preventiva',
        ]);
        $preventiva->imagens()->create(['path' => 'test/foto.jpg', 'recusada' => false, 'position' => 1]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.relatorio-medicao-pdf', $preventiva));

        $response->assertStatus(404);
    }

    public function test_relatorio_medicao_returns_404_without_descricao(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => null,
        ]);
        $imagem = $preventiva->imagens()->create(['path' => 'test/foto.jpg', 'recusada' => false, 'position' => 1]);
        $imagem->medicaoImagens()->create(['path' => 'test/medicao.jpg']);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.relatorio-medicao-pdf', $preventiva));

        $response->assertStatus(404);
    }

    public function test_relatorio_medicao_returns_404_without_imagem(): void
    {
        $preventiva = Preventiva::factory()->create([
            'descricao' => 'Descrição da preventiva',
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.preventivas.relatorio-medicao-pdf', $preventiva));

        $response->assertStatus(404);
    }

    public function test_non_admin_cannot_download_relatorio_medicao_pdf(): void
    {
        $prestador = User::factory()->prestador()->create();
        $preventiva = $this->createPreventivaElegivel();

        $response = $this->actingAs($prestador)
            ->get(route('admin.preventivas.relatorio-medicao-pdf', $preventiva));

        $response->assertStatus(403);
    }

    public function test_guest_cannot_download_relatorio_medicao_pdf(): void
    {
        $preventiva = $this->createPreventivaElegivel();

        $response = $this->get(route('admin.preventivas.relatorio-medicao-pdf', $preventiva));

        $response->assertRedirect(route('login'));
    }

    private function createPreventivaElegivel(): Preventiva
    {
        $preventiva = Preventiva::factory()->create([
            'status' => PreventivaStatus::Aberto,
            'descricao' => 'Descrição da preventiva',
        ]);
        $imagem = $preventiva->imagens()->create(['path' => 'test/foto.jpg', 'recusada' => false, 'position' => 1]);
        $imagem->medicaoImagens()->create(['path' => 'test/medicao.jpg']);

        return $preventiva;
    }
}
