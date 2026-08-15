<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\TipoImagemOcorrencia;
use App\Jobs\ProcessarImagemOcorrencia;
use App\Livewire\Admin\OcorrenciaFotoGaleria;
use App\Models\Ocorrencia;
use App\Models\OcorrenciaImagem;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
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

    public function test_dropzone_desabilitado_por_padrao(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, ['ocorrenciaId' => $ocorrencia->id])
            ->assertDontSee('dropOnAntes');
    }

    public function test_dropzone_habilitado_renderiza_handlers(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, [
                'ocorrenciaId' => $ocorrencia->id,
                'dropzoneHabilitado' => true,
            ])
            ->assertSee('dropOnAntes');
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
        Queue::fake();

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

        Queue::assertPushed(ProcessarImagemOcorrencia::class);
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

    public function test_adicionar_foto_aparece_no_topo_da_galeria(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, ['ocorrenciaId' => $ocorrencia->id])
            ->assertSeeInOrder(['Adicionar Foto', 'Antes', 'Depois']);
    }

    public function test_admin_can_salvar_legenda(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();
        $imagem = OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => 'test/antes.jpg',
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, ['ocorrenciaId' => $ocorrencia->id])
            ->call('salvarLegenda', $imagem->id, 'Fachada danificada')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencia_imagens', [
            'id' => $imagem->id,
            'legenda' => 'Fachada danificada',
        ]);
    }

    public function test_admin_cannot_salvar_legenda_de_outra_ocorrencia(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();
        $outraOcorrencia = Ocorrencia::factory()->create();
        $imagem = OcorrenciaImagem::create([
            'ocorrencia_id' => $outraOcorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => 'test/antes.jpg',
        ]);

        $this->expectException(ModelNotFoundException::class);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, ['ocorrenciaId' => $ocorrencia->id])
            ->call('salvarLegenda', $imagem->id, 'Legenda indevida');
    }

    public function test_processar_imagem_reduz_e_salva_como_jpg(): void
    {
        Storage::fake('public');

        $ocorrencia = Ocorrencia::factory()->create();
        $fakeImage = UploadedFile::fake()->image('foto.png', 2000, 1500);
        $path = $fakeImage->storeAs('ocorrencias/'.$ocorrencia->id.'/antes', 'foto.png', 'public');

        $imagem = OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => $path,
        ]);

        (new ProcessarImagemOcorrencia($imagem))->handle();

        $expectedPath = 'ocorrencias/'.$ocorrencia->id.'/antes/foto.jpg';
        Storage::disk('public')->assertExists($expectedPath);
        Storage::disk('public')->assertMissing('ocorrencias/'.$ocorrencia->id.'/antes/foto.png');

        $this->assertDatabaseHas('ocorrencia_imagens', [
            'id' => $imagem->id,
            'path' => $expectedPath,
        ]);
    }
}
