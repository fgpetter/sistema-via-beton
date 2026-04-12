<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\TipoImagemOcorrencia;
use App\Livewire\Admin\OcorrenciaFotoGaleria;
use App\Models\Ocorrencia;
use App\Models\OcorrenciaImagem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class OcorrenciaFotoGaleriaTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private User $prestador;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        $this->prestador = User::factory()->prestador()->create();
    }

    public function test_non_admin_cannot_mount_ocorrencia_foto_galeria(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->prestador)
            ->test(OcorrenciaFotoGaleria::class, ['ocorrenciaId' => $ocorrencia->id])
            ->assertForbidden();
    }

    public function test_admin_can_upload_foto_antes(): void
    {
        Storage::fake('public');

        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, ['ocorrenciaId' => $ocorrencia->id])
            ->set('uploadingPar', 1)
            ->set('uploadingTipo', TipoImagemOcorrencia::Antes->value)
            ->set('fotoUpload', UploadedFile::fake()->image('antes.jpg'))
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencia_imagens', [
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes->value,
            'par' => 1,
        ]);
    }

    public function test_admin_can_remover_imagem(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('test/antes.jpg', 'fake');

        $ocorrencia = Ocorrencia::factory()->create();
        $imagem = OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => 'test/antes.jpg',
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, ['ocorrenciaId' => $ocorrencia->id])
            ->call('removerImagem', $imagem->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('ocorrencia_imagens', [
            'id' => $imagem->id,
        ]);
    }

    public function test_admin_can_adicionar_par(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, ['ocorrenciaId' => $ocorrencia->id])
            ->call('adicionarPar')
            ->assertSet('totalPares', 2);
    }
}
