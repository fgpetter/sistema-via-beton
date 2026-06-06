<?php

namespace Tests\Feature\Livewire\Admin;

use App\Jobs\ProcessarImagemPreventiva;
use App\Livewire\Admin\PreventivaFotoGaleria;
use App\Models\Preventiva;
use App\Models\PreventivaImagem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class PreventivaFotoGaleriaTest extends TestCase
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
        $preventiva = Preventiva::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(PreventivaFotoGaleria::class, ['preventivaId' => $preventiva->id])
            ->assertDontSee('dropFoto');
    }

    public function test_dropzone_habilitado_renderiza_handlers(): void
    {
        $preventiva = Preventiva::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(PreventivaFotoGaleria::class, [
                'preventivaId' => $preventiva->id,
                'dropzoneHabilitado' => true,
            ])
            ->assertSee('dropFoto');
    }

    public function test_non_admin_cannot_mount_preventiva_foto_galeria(): void
    {
        $preventiva = Preventiva::factory()->create();

        Livewire::actingAs($this->prestador)
            ->test(PreventivaFotoGaleria::class, ['preventivaId' => $preventiva->id])
            ->assertForbidden();
    }

    public function test_admin_can_upload_foto(): void
    {
        Storage::fake('public');
        Queue::fake();

        $preventiva = Preventiva::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(PreventivaFotoGaleria::class, ['preventivaId' => $preventiva->id])
            ->set('fotoUpload', UploadedFile::fake()->image('foto.jpg'))
            ->assertHasNoErrors();

        $this->assertDatabaseHas('preventiva_imagens', [
            'preventiva_id' => $preventiva->id,
            'position' => 1,
        ]);

        Queue::assertPushed(ProcessarImagemPreventiva::class);
    }

    public function test_upload_define_position_incremental(): void
    {
        Storage::fake('public');
        Queue::fake();

        $preventiva = Preventiva::factory()->create();

        PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/existente.jpg',
            'position' => 1,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaFotoGaleria::class, ['preventivaId' => $preventiva->id])
            ->set('fotoUpload', UploadedFile::fake()->image('nova.jpg'))
            ->assertHasNoErrors();

        $this->assertDatabaseHas('preventiva_imagens', [
            'preventiva_id' => $preventiva->id,
            'position' => 2,
        ]);
    }

    public function test_admin_can_reordenar_imagens(): void
    {
        $preventiva = Preventiva::factory()->create();

        $imagem1 = PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/foto1.jpg',
            'position' => 1,
        ]);

        $imagem2 = PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/foto2.jpg',
            'position' => 2,
        ]);

        $imagem3 = PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/foto3.jpg',
            'position' => 3,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaFotoGaleria::class, ['preventivaId' => $preventiva->id])
            ->call('reordenarImagens', $imagem3->id, 0)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('preventiva_imagens', ['id' => $imagem3->id, 'position' => 1]);
        $this->assertDatabaseHas('preventiva_imagens', ['id' => $imagem1->id, 'position' => 2]);
        $this->assertDatabaseHas('preventiva_imagens', ['id' => $imagem2->id, 'position' => 3]);
    }

    public function test_galeria_exibe_imagens_ordenadas_por_position(): void
    {
        $preventiva = Preventiva::factory()->create();

        PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/terceira.jpg',
            'position' => 3,
        ]);

        PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/primeira.jpg',
            'position' => 1,
        ]);

        PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/segunda.jpg',
            'position' => 2,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaFotoGaleria::class, ['preventivaId' => $preventiva->id])
            ->assertSeeInOrder([
                'test/primeira.jpg',
                'test/segunda.jpg',
                'test/terceira.jpg',
            ])
            ->assertSee('wire:sort="reordenarImagens"', false);
    }

    public function test_admin_can_remover_imagem(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('test/foto.jpg', 'fake');

        $preventiva = Preventiva::factory()->create();
        $imagem = PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/foto.jpg',
            'position' => 1,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaFotoGaleria::class, ['preventivaId' => $preventiva->id])
            ->call('removerImagem', $imagem->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('preventiva_imagens', [
            'id' => $imagem->id,
        ]);
    }

    public function test_admin_can_salvar_legenda(): void
    {
        $preventiva = Preventiva::factory()->create();
        $imagem = PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/foto.jpg',
            'position' => 1,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaFotoGaleria::class, ['preventivaId' => $preventiva->id])
            ->call('salvarLegenda', $imagem->id, 'Fachada danificada')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('preventiva_imagens', [
            'id' => $imagem->id,
            'legenda' => 'Fachada danificada',
        ]);
    }

    public function test_admin_can_toggle_recusada(): void
    {
        $preventiva = Preventiva::factory()->create();
        $imagem = PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/foto.jpg',
            'recusada' => false,
            'position' => 1,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaFotoGaleria::class, ['preventivaId' => $preventiva->id])
            ->call('toggleRecusada', $imagem->id)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('preventiva_imagens', [
            'id' => $imagem->id,
            'recusada' => true,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaFotoGaleria::class, ['preventivaId' => $preventiva->id])
            ->call('toggleRecusada', $imagem->id)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('preventiva_imagens', [
            'id' => $imagem->id,
            'recusada' => false,
        ]);
    }

    public function test_admin_cannot_toggle_recusada_de_outra_preventiva(): void
    {
        $preventiva = Preventiva::factory()->create();
        $outraPreventiva = Preventiva::factory()->create();
        $imagem = PreventivaImagem::create([
            'preventiva_id' => $outraPreventiva->id,
            'path' => 'test/foto.jpg',
            'position' => 1,
        ]);

        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        Livewire::actingAs($this->admin)
            ->test(PreventivaFotoGaleria::class, ['preventivaId' => $preventiva->id])
            ->call('toggleRecusada', $imagem->id);
    }

    public function test_processar_imagem_reduz_e_salva_como_jpg(): void
    {
        Storage::fake('public');

        $preventiva = Preventiva::factory()->create();
        $fakeImage = UploadedFile::fake()->image('foto.png', 2000, 1500);
        $path = $fakeImage->storeAs('preventivas/'.$preventiva->id, 'foto.png', 'public');

        $imagem = PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => $path,
            'position' => 1,
        ]);

        (new ProcessarImagemPreventiva($imagem))->handle();

        $expectedPath = 'preventivas/'.$preventiva->id.'/foto.jpg';
        Storage::disk('public')->assertExists($expectedPath);
        Storage::disk('public')->assertMissing('preventivas/'.$preventiva->id.'/foto.png');

        $this->assertDatabaseHas('preventiva_imagens', [
            'id' => $imagem->id,
            'path' => $expectedPath,
        ]);
    }
}
