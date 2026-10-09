<?php

namespace Tests\Feature\Livewire\Admin;

use App\Enums\OcorrenciaStatus;
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
use PHPUnit\Framework\Attributes\DataProvider;
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
            ->assertSee('dropOnAntes')
            ->assertSee('dropOnDepois')
            ->assertSee('fotoInputDepois')
            ->assertSee('multiple');
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

    public function test_admin_pode_enviar_varias_fotos_antes_em_pares_novos(): void
    {
        Storage::fake('public');
        Queue::fake();

        $ocorrencia = Ocorrencia::factory()->create();

        $component = Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, ['ocorrenciaId' => $ocorrencia->id])
            ->set('uploadingPar', 1)
            ->set('uploadingTipo', TipoImagemOcorrencia::Antes->value);

        foreach (['antes1.jpg', 'antes2.jpg', 'antes3.jpg'] as $filename) {
            $component->set('fotoUpload', UploadedFile::fake()->image($filename));
        }

        $this->assertDatabaseCount('ocorrencia_imagens', 3);
        $this->assertSame(
            [1, 2, 3],
            OcorrenciaImagem::query()
                ->where('ocorrencia_id', $ocorrencia->id)
                ->orderBy('par')
                ->pluck('par')
                ->all()
        );
        Queue::assertPushed(ProcessarImagemOcorrencia::class, 3);
        $component
            ->assertHasNoErrors()
            ->assertSet('uploadingPar', 1)
            ->assertSet('uploadingTipo', TipoImagemOcorrencia::Antes->value)
            ->assertSet('totalPares', 3);
    }

    public function test_admin_nao_pode_enviar_foto_depois_sem_antes(): void
    {
        Storage::fake('public');
        Queue::fake();

        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, ['ocorrenciaId' => $ocorrencia->id])
            ->set('uploadingPar', 1)
            ->set('uploadingTipo', TipoImagemOcorrencia::Depois->value)
            ->set('fotoUpload', UploadedFile::fake()->image('depois.jpg'))
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('ocorrencia_imagens', [
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Depois->value,
        ]);
        Queue::assertNothingPushed();
    }

    #[DataProvider('ocorrenciaStatusProvider')]
    public function test_admin_pode_enviar_foto_depois_em_qualquer_status(OcorrenciaStatus $status): void
    {
        Storage::fake('public');
        Queue::fake();

        $ocorrencia = Ocorrencia::factory()->create(['status' => $status]);
        OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => 'ocorrencias/'.$ocorrencia->id.'/antes/antes.jpg',
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, ['ocorrenciaId' => $ocorrencia->id])
            ->set('uploadingPar', 1)
            ->set('uploadingTipo', TipoImagemOcorrencia::Depois->value)
            ->set('fotoUpload', UploadedFile::fake()->image('depois.jpg'))
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencia_imagens', [
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Depois->value,
            'par' => 1,
        ]);
    }

    /**
     * @return array<string, array{0: OcorrenciaStatus}>
     */
    public static function ocorrenciaStatusProvider(): array
    {
        return collect(OcorrenciaStatus::cases())
            ->mapWithKeys(fn (OcorrenciaStatus $status) => [$status->value => [$status]])
            ->all();
    }

    public function test_slot_depois_sem_antes_nao_permite_envio(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, [
                'ocorrenciaId' => $ocorrencia->id,
                'dropzoneHabilitado' => true,
            ])
            ->assertDontSee('clickDepois(1)')
            ->assertDontSee('dropOnDepois($event, 1)');
    }

    public function test_slot_depois_com_antes_permite_envio(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();
        OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => 'ocorrencias/'.$ocorrencia->id.'/antes/antes.jpg',
        ]);

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, [
                'ocorrenciaId' => $ocorrencia->id,
                'dropzoneHabilitado' => true,
            ])
            ->assertSee('clickDepois(1)')
            ->assertSee('dropOnDepois($event, 1)')
            ->assertSee('fotoInputDepois.click()');
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

    public function test_slot_vazio_sempre_no_fim_sem_fotos(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        $component = Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, [
                'ocorrenciaId' => $ocorrencia->id,
                'dropzoneHabilitado' => true,
            ])
            ->assertDontSee('Adicionar Foto')
            ->assertSee('clickAntes(1)');

        $pares = $component->instance()->fotoPares;
        $this->assertSame([1], array_keys($pares));
        $this->assertNull($pares[1]['antes']);
    }

    public function test_novo_espaco_de_foto_aparece_no_fim_da_lista(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();
        OcorrenciaImagem::create([
            'ocorrencia_id' => $ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => 'ocorrencias/existente/antes.jpg',
        ]);

        $component = Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, [
                'ocorrenciaId' => $ocorrencia->id,
                'dropzoneHabilitado' => true,
            ])
            ->assertSeeInOrder([
                'admin-foto-par-1',
                'admin-foto-par-2',
            ])
            ->assertSee('clickAntes(2)');

        $pares = $component->instance()->fotoPares;
        $this->assertSame([1, 2], array_keys($pares));
        $this->assertNotNull($pares[1]['antes']);
        $this->assertNull($pares[2]['antes']);
    }

    public function test_galeria_exibe_slots_antes_depois_sem_botao_adicionar(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        Livewire::actingAs($this->admin)
            ->test(OcorrenciaFotoGaleria::class, ['ocorrenciaId' => $ocorrencia->id])
            ->assertDontSee('Adicionar Foto')
            ->assertSeeInOrder(['Antes', 'Depois']);
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
