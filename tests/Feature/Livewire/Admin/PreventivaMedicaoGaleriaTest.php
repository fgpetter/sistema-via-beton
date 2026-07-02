<?php

namespace Tests\Feature\Livewire\Admin;

use App\Jobs\ProcessarImagemMedicaoPreventiva;
use App\Livewire\Admin\PreventivaFotoGaleria;
use App\Livewire\Admin\PreventivaMedicaoGaleria;
use App\Models\Preventiva;
use App\Models\PreventivaImagem;
use App\Models\PreventivaMedicaoImagem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class PreventivaMedicaoGaleriaTest extends TestCase
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

    public function test_non_admin_cannot_mount_preventiva_medicao_galeria(): void
    {
        $preventiva = Preventiva::factory()->create();

        Livewire::actingAs($this->prestador)
            ->test(PreventivaMedicaoGaleria::class, ['preventivaId' => $preventiva->id])
            ->assertForbidden();
    }

    public function test_exibe_mensagem_quando_nao_ha_fotos_aceitas(): void
    {
        $preventiva = Preventiva::factory()->create();

        PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/recusada.jpg',
            'recusada' => true,
            'position' => 1,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaMedicaoGaleria::class, ['preventivaId' => $preventiva->id])
            ->assertSee('Adicione fotos aceitas na galeria acima para habilitar o relatório de medição.');
    }

    public function test_admin_can_upload_multiplas_fotos_de_medicao(): void
    {
        Storage::fake('public');
        Queue::fake();

        $preventiva = Preventiva::factory()->create();
        $imagemAntes = PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/antes.jpg',
            'position' => 1,
        ]);

        $component = Livewire::actingAs($this->admin)
            ->test(PreventivaMedicaoGaleria::class, ['preventivaId' => $preventiva->id])
            ->set('uploadingAntesId', $imagemAntes->id)
            ->set('fotoUpload', UploadedFile::fake()->image('depois1.jpg'))
            ->assertHasNoErrors()
            ->set('uploadingAntesId', $imagemAntes->id)
            ->set('fotoUpload', UploadedFile::fake()->image('depois2.jpg'))
            ->assertHasNoErrors();

        $this->assertDatabaseCount('preventiva_medicao_imagens', 2);
        $this->assertDatabaseHas('preventiva_medicao_imagens', [
            'preventiva_imagem_id' => $imagemAntes->id,
        ]);

        Queue::assertPushed(ProcessarImagemMedicaoPreventiva::class, 2);

        $component->assertSee('Relatório de Medição (2)');
    }

    public function test_admin_can_remover_foto_de_medicao(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('test/medicao.jpg', 'fake');

        $preventiva = Preventiva::factory()->create();
        $imagemAntes = PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/antes.jpg',
            'position' => 1,
        ]);

        $medicaoImagem = PreventivaMedicaoImagem::create([
            'preventiva_imagem_id' => $imagemAntes->id,
            'path' => 'test/medicao.jpg',
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaMedicaoGaleria::class, ['preventivaId' => $preventiva->id])
            ->call('removerMedicaoImagem', $medicaoImagem->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('preventiva_medicao_imagens', [
            'id' => $medicaoImagem->id,
        ]);

        Storage::disk('public')->assertMissing('test/medicao.jpg');
    }

    public function test_foto_recusada_nao_aparece_na_secao_de_medicao(): void
    {
        $preventiva = Preventiva::factory()->create();

        PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/recusada.jpg',
            'recusada' => true,
            'position' => 1,
        ]);

        $imagemAceita = PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/aceita.jpg',
            'recusada' => false,
            'position' => 2,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaMedicaoGaleria::class, ['preventivaId' => $preventiva->id])
            ->assertSee('test/aceita.jpg')
            ->assertDontSee('test/recusada.jpg');
    }

    public function test_evento_atualiza_linhas_apos_upload_na_galeria_principal(): void
    {
        Storage::fake('public');
        Queue::fake();

        $preventiva = Preventiva::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(PreventivaMedicaoGaleria::class, ['preventivaId' => $preventiva->id])
            ->assertSee('Adicione fotos aceitas na galeria acima para habilitar o relatório de medição.');

        Livewire::actingAs($this->admin)
            ->test(PreventivaFotoGaleria::class, ['preventivaId' => $preventiva->id])
            ->set('fotoUpload', UploadedFile::fake()->image('nova.jpg'))
            ->assertHasNoErrors();

        Livewire::actingAs($this->admin)
            ->test(PreventivaMedicaoGaleria::class, ['preventivaId' => $preventiva->id])
            ->dispatch('preventiva-imagens-atualizadas')
            ->assertDontSee('Adicione fotos aceitas na galeria acima para habilitar o relatório de medição.')
            ->assertSee('Antes')
            ->assertSee('Depois');
    }

    public function test_deletar_preventiva_imagem_remove_medicao_vinculada(): void
    {
        $preventiva = Preventiva::factory()->create();
        $imagemAntes = PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/antes.jpg',
            'position' => 1,
        ]);

        $medicaoImagem = PreventivaMedicaoImagem::create([
            'preventiva_imagem_id' => $imagemAntes->id,
            'path' => 'test/medicao.jpg',
        ]);

        $imagemAntes->delete();

        $this->assertDatabaseMissing('preventiva_medicao_imagens', [
            'id' => $medicaoImagem->id,
        ]);
    }

    public function test_nao_exibe_controle_de_reordenacao(): void
    {
        $preventiva = Preventiva::factory()->create();
        $imagemAntes = PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/antes.jpg',
            'position' => 1,
        ]);

        PreventivaMedicaoImagem::create([
            'preventiva_imagem_id' => $imagemAntes->id,
            'path' => 'test/medicao.jpg',
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaMedicaoGaleria::class, ['preventivaId' => $preventiva->id])
            ->assertDontSee('wire:sort', false);
    }

    public function test_dropzone_habilitado_renderiza_handlers(): void
    {
        $preventiva = Preventiva::factory()->create();

        PreventivaImagem::create([
            'preventiva_id' => $preventiva->id,
            'path' => 'test/antes.jpg',
            'position' => 1,
        ]);

        Livewire::actingAs($this->admin)
            ->test(PreventivaMedicaoGaleria::class, [
                'preventivaId' => $preventiva->id,
                'dropzoneHabilitado' => true,
            ])
            ->assertSee('dropDepois');
    }
}
