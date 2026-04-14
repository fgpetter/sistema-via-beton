<?php

namespace Tests\Feature\Admin;

use App\Models\Ocorrencia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DownloadRelatorioAtendimentoPdfTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pode_gerar_relatorio_atendimento_pdf(): void
    {
        Storage::fake('public');

        $admin = User::factory()->admin()->create();
        $ocorrencia = Ocorrencia::factory()->create();

        $response = $this->actingAs($admin)->get(route('admin.ocorrencias.relatorio-atendimento-pdf', $ocorrencia));

        $response->assertOk();
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_pdf_e_salvo_no_storage_apos_geracao(): void
    {
        Storage::fake('public');

        $admin = User::factory()->admin()->create();
        $ocorrencia = Ocorrencia::factory()->create();

        $this->actingAs($admin)->get(route('admin.ocorrencias.relatorio-atendimento-pdf', $ocorrencia));

        $path = 'ocorrencias/'.$ocorrencia->id.'/relatorio/RelatorioAtendimento-'.$ocorrencia->id.'.pdf';
        Storage::disk('public')->assertExists($path);
    }

    public function test_prestador_nao_pode_acessar_relatorio_atendimento_pdf(): void
    {
        $prestador = User::factory()->prestador()->create();
        $ocorrencia = Ocorrencia::factory()->create();

        $response = $this->actingAs($prestador)->get(route('admin.ocorrencias.relatorio-atendimento-pdf', $ocorrencia));

        $response->assertForbidden();
    }

    public function test_guest_e_redirecionado_para_login(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        $response = $this->get(route('admin.ocorrencias.relatorio-atendimento-pdf', $ocorrencia));

        $response->assertRedirect();
    }

    public function test_ocorrencia_sem_imagens_gera_pdf_sem_erros(): void
    {
        Storage::fake('public');

        $admin = User::factory()->admin()->create();
        $ocorrencia = Ocorrencia::factory()->create();

        $response = $this->actingAs($admin)->get(route('admin.ocorrencias.relatorio-atendimento-pdf', $ocorrencia));

        $response->assertOk();
        $response->assertHeader('content-type', 'application/pdf');
    }
}
