<?php

namespace App\Livewire\Prestador;

use App\Enums\OcorrenciaStatus;
use App\Enums\TipoImagemOcorrencia;
use App\Models\Ocorrencia;
use App\Models\OcorrenciaImagem;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

#[Layout('layouts.vertical')]
#[Title('Detalhes do Atendimento')]
class AtendimentoDetalhe extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    #[Locked]
    public int $ocorrenciaId;

    public ?string $comentariosPrestador = null;

    public ?string $emailRat = null;

    public $fotoUpload;

    public ?int $uploadingPar = null;

    public ?string $uploadingTipo = null;

    public int $totalPares = 1;

    public function mount(int $ocorrenciaId): void
    {
        $this->ocorrenciaId = $ocorrenciaId;
        $ocorrencia = $this->ensureUserOwnsOcorrencia();
        $this->comentariosPrestador = $ocorrencia->comentarios_prestador;
        $this->emailRat = $ocorrencia->email_rat;
        $this->totalPares = max(1, (int) $ocorrencia->imagens()->max('par'));
    }

    protected function rules(): array
    {
        return [
            'comentariosPrestador' => ['nullable', 'string'],
            'emailRat' => ['nullable', 'email', 'max:255'],
            'fotoUpload' => ['nullable', 'image', 'max:5120'],
        ];
    }

    protected function messages(): array
    {
        return [
            'emailRat.email' => 'O e-mail informado não é válido.',
            'emailRat.max' => 'O e-mail não pode ter mais de 255 caracteres.',
            'fotoUpload.image' => 'O arquivo deve ser uma imagem.',
            'fotoUpload.max' => 'A imagem deve ter no máximo 5MB.',
        ];
    }

    #[Computed]
    public function ocorrencia(): Ocorrencia
    {
        return Ocorrencia::with(['colaborador', 'imagens', 'imagensAntes', 'imagensDepois', 'concluidoPor', 'enderecoVinculado'])
            ->findOrFail($this->ocorrenciaId);
    }

    public function iniciarAtendimento(): void
    {
        $ocorrencia = $this->ensureUserOwnsOcorrencia();

        if ($ocorrencia->atendimentoIniciado() || ! in_array($ocorrencia->status, [OcorrenciaStatus::Aberto, OcorrenciaStatus::Andamento])) {
            abort(403, 'Não é possível iniciar este atendimento.');
        }

        $ocorrencia->update([
            'datahora_chegada' => now(),
            'status' => OcorrenciaStatus::Andamento,
        ]);
        unset($this->ocorrencia);

        $this->swalToastSuccess(['title' => 'Atendimento iniciado!', 'showConfirmButton' => false, 'position' => 'top-end', 'timer' => 2000]);
    }

    #[Computed]
    public function fotoPares(): array
    {
        return $this->ocorrencia->fotoPares($this->totalPares);
    }

    public function adicionarPar(): void
    {
        $this->totalPares++;
    }

    public function updatedFotoUpload(): void
    {
        if (! $this->fotoUpload || $this->uploadingPar === null || ! $this->uploadingTipo) {
            return;
        }

        $this->ensureUserOwnsOcorrencia();
        $this->validateOnly('fotoUpload');

        $tipo = TipoImagemOcorrencia::from($this->uploadingTipo);
        $path = $this->fotoUpload->store("ocorrencias/{$this->ocorrenciaId}/{$tipo->value}", 'public');

        OcorrenciaImagem::create([
            'ocorrencia_id' => $this->ocorrenciaId,
            'tipo' => $tipo,
            'par' => $this->uploadingPar,
            'path' => $path,
        ]);

        $this->reset(['fotoUpload', 'uploadingPar', 'uploadingTipo']);
        unset($this->ocorrencia, $this->fotoPares);

        $this->swalToastSuccess(['title' => 'Foto enviada!', 'showConfirmButton' => false, 'position' => 'top-end', 'timer' => 2000]);
    }

    public function removerImagem(int $imagemId): void
    {
        $this->ensureAtendimentoIniciado();

        $imagem = OcorrenciaImagem::where('ocorrencia_id', $this->ocorrenciaId)
            ->findOrFail($imagemId);

        Storage::disk('public')->delete($imagem->path);
        $imagem->delete();
        unset($this->ocorrencia, $this->fotoPares);
    }

    public function salvarComentarios(): void
    {
        $this->ensureAtendimentoIniciado();
        $this->validateOnly('comentariosPrestador');
        $this->ocorrencia->update(['comentarios_prestador' => $this->comentariosPrestador]);

        $this->swalToastSuccess(['title' => 'Comentários salvos!', 'showConfirmButton' => false, 'position' => 'top-end', 'timer' => 2000]);
    }

    public function enviarEmail(): void
    {
        $this->ensureAtendimentoIniciado();
        $this->validateOnly('emailRat');

        if (! $this->emailRat) {
            $this->addError('emailRat', 'Informe o e-mail para enviar a RAT.');

            return;
        }

        $this->ocorrencia->update(['email_rat' => $this->emailRat, 'email_rat_enviado' => now()]);
        unset($this->ocorrencia);

        $this->swalToastSuccess(['title' => 'E-mail registrado com sucesso!', 'showConfirmButton' => false, 'position' => 'top-end', 'timer' => 2000]);
    }

    public function concluir(): void
    {
        $ocorrencia = $this->ensureAtendimentoIniciado();

        if (! $ocorrencia->podeConcluir()) {
            $this->swalToastWarning([
                'title' => 'Não é possível concluir',
                'text' => 'É necessário ao menos 1 foto de antes, 1 de depois e ter enviado o e-mail.',
                'showConfirmButton' => true,
                'position' => 'top-end',
            ]);

            return;
        }

        $ocorrencia->update([
            'datahora_saida' => now(),
            'status' => OcorrenciaStatus::Revisar,
        ]);
        unset($this->ocorrencia);

        $this->swalToastSuccess(['title' => 'Atendimento concluído! Aguardando revisão.', 'showConfirmButton' => false, 'position' => 'top-end', 'timer' => 2000]);
    }

    protected function ensureAtendimentoIniciado(): Ocorrencia
    {
        $ocorrencia = $this->ensureUserOwnsOcorrencia();

        if (! $ocorrencia->atendimentoIniciado()) {
            abort(403, 'O atendimento ainda não foi iniciado.');
        }

        return $ocorrencia;
    }

    protected function ensureUserOwnsOcorrencia(): Ocorrencia
    {
        /** @var User $user */
        $user = auth()->user();
        $colaborador = $user->colaborador;
        $ocorrencia = Ocorrencia::findOrFail($this->ocorrenciaId);

        if (! $colaborador || $ocorrencia->colaborador_id !== $colaborador->id) {
            abort(403, 'Você não tem permissão para acessar esta ocorrência.');
        }

        return $ocorrencia;
    }

    public function render(): View
    {
        return view('livewire.prestador.atendimento-detalhe');
    }
}
