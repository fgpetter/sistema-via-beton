<?php

namespace Tests\Feature\Admin;

use App\Models\Ocorrencia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DownloadRatPdfTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_rat_pdf_when_file_exists(): void
    {
        Storage::fake('public');

        $admin = User::factory()->admin()->create();
        $ocorrencia = Ocorrencia::factory()->create();
        $path = 'ocorrencias/'.$ocorrencia->id.'/rat/RAT-'.$ocorrencia->id.'.pdf';
        Storage::disk('public')->put($path, '%PDF-1.4 test content');
        $ocorrencia->update(['rat_pdf_path' => $path]);

        $response = $this->actingAs($admin)->get(route('admin.ocorrencias.rat-pdf', $ocorrencia));

        $response->assertOk();
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_prestador_cannot_access_rat_pdf_route(): void
    {
        Storage::fake('public');

        $prestador = User::factory()->prestador()->create();
        $ocorrencia = Ocorrencia::factory()->create();
        $path = 'ocorrencias/'.$ocorrencia->id.'/rat/RAT-'.$ocorrencia->id.'.pdf';
        Storage::disk('public')->put($path, '%PDF-1.4 test');
        $ocorrencia->update(['rat_pdf_path' => $path]);

        $response = $this->actingAs($prestador)->get(route('admin.ocorrencias.rat-pdf', $ocorrencia));

        $response->assertForbidden();
    }

    public function test_guest_is_redirected_from_rat_pdf_route(): void
    {
        $ocorrencia = Ocorrencia::factory()->create();

        $response = $this->get(route('admin.ocorrencias.rat-pdf', $ocorrencia));

        $response->assertRedirect();
    }

    public function test_rat_pdf_returns_404_when_path_is_null(): void
    {
        $admin = User::factory()->admin()->create();
        $ocorrencia = Ocorrencia::factory()->create(['rat_pdf_path' => null]);

        $response = $this->actingAs($admin)->get(route('admin.ocorrencias.rat-pdf', $ocorrencia));

        $response->assertNotFound();
    }

    public function test_rat_pdf_returns_404_when_file_missing_on_disk(): void
    {
        Storage::fake('public');

        $admin = User::factory()->admin()->create();
        $ocorrencia = Ocorrencia::factory()->create([
            'rat_pdf_path' => 'ocorrencias/999/rat/missing.pdf',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.ocorrencias.rat-pdf', $ocorrencia));

        $response->assertNotFound();
    }
}
