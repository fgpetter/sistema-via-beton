<?php

namespace Tests\Feature\Livewire\Prestador;

use App\Enums\OcorrenciaStatus;
use App\Enums\TipoImagemOcorrencia;
use App\Livewire\Prestador\AtendimentoDetalhe;
use App\Models\Colaborador;
use App\Models\Ocorrencia;
use App\Models\OcorrenciaImagem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class AtendimentoDetalheTest extends TestCase
{
    use RefreshDatabase;

    private User $prestador;

    private Colaborador $colaborador;

    private Ocorrencia $ocorrencia;

    protected function setUp(): void
    {
        parent::setUp();

        $this->prestador = User::factory()->prestador()->create();
        $this->colaborador = Colaborador::factory()->create(['user_id' => $this->prestador->id]);
        $this->ocorrencia = Ocorrencia::factory()->emAtendimentoIniciado()->create([
            'colaborador_id' => $this->colaborador->id,
            'email_enviado' => null,
        ]);
    }

    public function test_prestador_can_access_atendimento_page(): void
    {
        $response = $this->actingAs($this->prestador)
            ->get(route('prestador.atendimento', $this->ocorrencia->id));

        $response->assertStatus(200);
        $response->assertSee('Detalhes do Atendimento');
    }

    public function test_prestador_cannot_access_another_prestador_ocorrencia(): void
    {
        $outroPrestador = User::factory()->prestador()->create();
        $outroColaborador = Colaborador::factory()->create(['user_id' => $outroPrestador->id]);
        $outraOcorrencia = Ocorrencia::factory()->create(['colaborador_id' => $outroColaborador->id]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $outraOcorrencia->id])
            ->assertForbidden();
    }

    public function test_prestador_can_see_ocorrencia_details(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->assertSee($this->ocorrencia->titulo)
            ->assertSee($this->ocorrencia->agencia);
    }

    public function test_prestador_can_see_iniciar_atendimento_button_when_not_started(): void
    {
        $ocorrencia = Ocorrencia::factory()->emAndamento()->create([
            'colaborador_id' => $this->colaborador->id,
            'datahora_chegada' => null,
        ]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->assertSee('Iniciar Atendimento');
    }

    public function test_prestador_can_iniciar_atendimento(): void
    {
        $this->freezeTime();

        $ocorrencia = Ocorrencia::factory()->emAndamento()->create([
            'colaborador_id' => $this->colaborador->id,
            'datahora_chegada' => null,
        ]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->call('iniciarAtendimento')
            ->assertHasNoErrors();

        $ocorrencia->refresh();
        $this->assertNotNull($ocorrencia->datahora_chegada);
        $this->assertEquals(now()->startOfSecond()->toDateTimeString(), $ocorrencia->datahora_chegada->toDateTimeString());
    }

    public function test_prestador_cannot_iniciar_atendimento_twice(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->call('iniciarAtendimento')
            ->assertForbidden();
    }

    public function test_prestador_can_iniciar_atendimento_from_aberto(): void
    {
        $this->freezeTime();

        $ocorrencia = Ocorrencia::factory()->aberto()->create([
            'colaborador_id' => $this->colaborador->id,
            'datahora_chegada' => null,
        ]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->call('iniciarAtendimento')
            ->assertHasNoErrors();

        $ocorrencia->refresh();
        $this->assertEquals(OcorrenciaStatus::Andamento, $ocorrencia->status);
        $this->assertNotNull($ocorrencia->datahora_chegada);
    }

    public function test_prestador_cannot_iniciar_atendimento_with_wrong_status(): void
    {
        $ocorrencia = Ocorrencia::factory()->revisar()->create([
            'colaborador_id' => $this->colaborador->id,
        ]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->call('iniciarAtendimento')
            ->assertForbidden();
    }

    public function test_prestador_can_save_comentarios(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->set('comentariosPrestador', 'Trabalho realizado com sucesso')
            ->call('salvarComentarios')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencias', [
            'id' => $this->ocorrencia->id,
            'comentarios_prestador' => 'Trabalho realizado com sucesso',
        ]);
    }

    public function test_prestador_cannot_save_comentarios_before_iniciar(): void
    {
        $ocorrencia = Ocorrencia::factory()->emAndamento()->create([
            'colaborador_id' => $this->colaborador->id,
        ]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->set('comentariosPrestador', 'Teste')
            ->call('salvarComentarios')
            ->assertForbidden();
    }

    public function test_prestador_can_upload_foto_antes(): void
    {
        Storage::fake('public');

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->set('uploadingPar', 1)
            ->set('uploadingTipo', TipoImagemOcorrencia::Antes->value)
            ->set('fotoUpload', UploadedFile::fake()->image('antes1.jpg'))
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencia_imagens', [
            'ocorrencia_id' => $this->ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes->value,
            'par' => 1,
        ]);
    }

    public function test_prestador_can_upload_foto_depois(): void
    {
        Storage::fake('public');

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->set('uploadingPar', 1)
            ->set('uploadingTipo', TipoImagemOcorrencia::Depois->value)
            ->set('fotoUpload', UploadedFile::fake()->image('depois1.jpg'))
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ocorrencia_imagens', [
            'ocorrencia_id' => $this->ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Depois->value,
            'par' => 1,
        ]);
    }

    public function test_prestador_can_upload_multiple_pairs(): void
    {
        Storage::fake('public');

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->set('uploadingPar', 1)
            ->set('uploadingTipo', TipoImagemOcorrencia::Antes->value)
            ->set('fotoUpload', UploadedFile::fake()->image('antes1.jpg'))
            ->set('uploadingPar', 1)
            ->set('uploadingTipo', TipoImagemOcorrencia::Depois->value)
            ->set('fotoUpload', UploadedFile::fake()->image('depois1.jpg'))
            ->set('uploadingPar', 2)
            ->set('uploadingTipo', TipoImagemOcorrencia::Antes->value)
            ->set('fotoUpload', UploadedFile::fake()->image('antes2.jpg'))
            ->assertHasNoErrors();

        $this->assertEquals(3, OcorrenciaImagem::where('ocorrencia_id', $this->ocorrencia->id)->count());
        $this->assertDatabaseHas('ocorrencia_imagens', [
            'ocorrencia_id' => $this->ocorrencia->id,
            'par' => 2,
            'tipo' => TipoImagemOcorrencia::Antes->value,
        ]);
    }

    public function test_prestador_can_remove_image(): void
    {
        Storage::fake('public');

        $imagem = OcorrenciaImagem::create([
            'ocorrencia_id' => $this->ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => 'ocorrencias/test/antes/test.jpg',
        ]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->call('removerImagem', $imagem->id);

        $this->assertDatabaseMissing('ocorrencia_imagens', ['id' => $imagem->id]);
    }

    public function test_prestador_can_enviar_email(): void
    {
        $this->freezeTime();

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->set('emailRat', 'contato@agencia.com')
            ->call('enviarEmail')
            ->assertHasNoErrors();

        $this->ocorrencia->refresh();
        $this->assertEquals('contato@agencia.com', $this->ocorrencia->email_rat);
        $this->assertNotNull($this->ocorrencia->email_rat_enviado);
    }

    public function test_enviar_email_requires_email(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->set('emailRat', null)
            ->call('enviarEmail')
            ->assertHasErrors(['emailRat']);
    }

    public function test_enviar_email_validates_format(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->set('emailRat', 'email-invalido')
            ->call('enviarEmail')
            ->assertHasErrors(['emailRat']);
    }

    public function test_prestador_cannot_concluir_without_requirements(): void
    {
        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->call('concluir');

        $this->ocorrencia->refresh();
        $this->assertNotEquals(OcorrenciaStatus::Revisar, $this->ocorrencia->status);
    }

    public function test_prestador_can_concluir_with_all_requirements(): void
    {
        $this->freezeTime();
        Storage::fake('public');

        OcorrenciaImagem::create([
            'ocorrencia_id' => $this->ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => 'test/antes.jpg',
        ]);
        OcorrenciaImagem::create([
            'ocorrencia_id' => $this->ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Depois,
            'par' => 1,
            'path' => 'test/depois.jpg',
        ]);
        $this->ocorrencia->update(['email_rat_enviado' => now()]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->call('concluir')
            ->assertHasNoErrors();

        $this->ocorrencia->refresh();
        $this->assertEquals(OcorrenciaStatus::Revisar, $this->ocorrencia->status);
        $this->assertNotNull($this->ocorrencia->datahora_saida);
        $this->assertEquals(now()->startOfSecond()->toDateTimeString(), $this->ocorrencia->datahora_saida->toDateTimeString());
    }

    public function test_prestador_cannot_concluir_without_antes_image(): void
    {
        OcorrenciaImagem::create([
            'ocorrencia_id' => $this->ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Depois,
            'par' => 1,
            'path' => 'test/depois.jpg',
        ]);
        $this->ocorrencia->update(['email_rat_enviado' => now()]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->call('concluir');

        $this->ocorrencia->refresh();
        $this->assertNotEquals(OcorrenciaStatus::Revisar, $this->ocorrencia->status);
    }

    public function test_prestador_cannot_concluir_without_email_sent(): void
    {
        OcorrenciaImagem::create([
            'ocorrencia_id' => $this->ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Antes,
            'par' => 1,
            'path' => 'test/antes.jpg',
        ]);
        OcorrenciaImagem::create([
            'ocorrencia_id' => $this->ocorrencia->id,
            'tipo' => TipoImagemOcorrencia::Depois,
            'par' => 1,
            'path' => 'test/depois.jpg',
        ]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $this->ocorrencia->id])
            ->call('concluir');

        $this->ocorrencia->refresh();
        $this->assertNotEquals(OcorrenciaStatus::Revisar, $this->ocorrencia->status);
    }

    public function test_prestador_cannot_concluir_before_iniciar(): void
    {
        $ocorrencia = Ocorrencia::factory()->emAndamento()->create([
            'colaborador_id' => $this->colaborador->id,
            'datahora_chegada' => null,
        ]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->call('concluir')
            ->assertForbidden();
    }

    public function test_guest_cannot_access_atendimento_page(): void
    {
        $response = $this->get(route('prestador.atendimento', $this->ocorrencia->id));

        $response->assertRedirect(route('login'));
    }

    public function test_prestador_sees_revisar_message_after_concluding(): void
    {
        $ocorrencia = Ocorrencia::factory()->revisar()->create([
            'colaborador_id' => $this->colaborador->id,
        ]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->assertSee('Aguardando revisão do administrador');
    }

    public function test_prestador_sees_concluida_message(): void
    {
        $ocorrencia = Ocorrencia::factory()->concluida()->create([
            'colaborador_id' => $this->colaborador->id,
        ]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->assertSee('Esta ocorrência foi concluída');
    }

    public function test_prestador_sees_revisado_por_when_concluida(): void
    {
        $admin = User::factory()->admin()->create(['name' => 'João Admin']);

        $ocorrencia = Ocorrencia::factory()->concluida()->create([
            'colaborador_id' => $this->colaborador->id,
            'concluido_por' => $admin->id,
        ]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->assertSee('Revisado por:')
            ->assertSee('João Admin');
    }

    public function test_prestador_sees_iniciar_atendimento_when_aberto(): void
    {
        $ocorrencia = Ocorrencia::factory()->aberto()->create([
            'colaborador_id' => $this->colaborador->id,
            'datahora_chegada' => null,
        ]);

        Livewire::actingAs($this->prestador)
            ->test(AtendimentoDetalhe::class, ['ocorrenciaId' => $ocorrencia->id])
            ->assertSee('Iniciar Atendimento')
            ->assertDontSee('Esta ocorrência foi concluída');
    }
}
