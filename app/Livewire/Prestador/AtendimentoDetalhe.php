<?php

namespace App\Livewire\Prestador;

use App\Actions\Ocorrencias\RenderRatPdfFromOcorrencia;
use App\Enums\OcorrenciaStatus;
use App\Enums\TipoImagemOcorrencia;
use App\Jobs\ProcessarImagemOcorrencia;
use App\Mail\OcorrenciaConcluida;
use App\Mail\RatEnviada;
use App\Models\Ocorrencia;
use App\Models\OcorrenciaImagem;
use App\Models\User;
use App\Support\SwalToast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
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

    public int $totalPares = 0;

    public function mount(int $ocorrenciaId): void
    {
        $this->ocorrenciaId = $ocorrenciaId;
        $ocorrencia = $this->ensureUserOwnsOcorrencia();
        $this->comentariosPrestador = $ocorrencia->comentarios_prestador;
        $this->emailRat = $ocorrencia->email_rat;
        $this->totalPares = (int) $ocorrencia->imagens()->max('par');
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
        return Ocorrencia::with(['colaborador', 'prazo', 'imagens', 'imagensAntes', 'imagensDepois', 'concluidoPor', 'enderecoVinculado'])
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

        $this->swalToastSuccess(SwalToast::successOptions('Atendimento iniciado!'));
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

        $imagem = OcorrenciaImagem::create([
            'ocorrencia_id' => $this->ocorrenciaId,
            'tipo' => $tipo,
            'par' => $this->uploadingPar,
            'path' => $path,
        ]);

        ProcessarImagemOcorrencia::dispatch($imagem);

        $this->reset(['fotoUpload', 'uploadingPar', 'uploadingTipo']);
        unset($this->ocorrencia, $this->fotoPares);

        $this->swalToastSuccess(SwalToast::successOptions('Foto enviada!'));
    }

    public function removerImagem(int $imagemId): void
    {
        $this->ensureAtendimentoIniciado();

        $imagem = OcorrenciaImagem::where('ocorrencia_id', $this->ocorrenciaId)
            ->findOrFail($imagemId);

        Storage::disk('public')->delete($imagem->path);
        $imagem->delete();
        unset($this->ocorrencia, $this->fotoPares);

        if (! $this->ocorrencia->imagens()->exists()) {
            $this->totalPares = 0;
        }

        $this->swalToastSuccess(SwalToast::successOptions('Foto removida!'));
    }

    public function salvarComentarios(): void
    {
        $this->ensureAtendimentoIniciado();
        $this->validateOnly('comentariosPrestador');
        $this->ocorrencia->update(['comentarios_prestador' => $this->comentariosPrestador]);

        $this->swalToastSuccess(SwalToast::successOptions('Comentários salvos!'));
    }

    public function enviarEmail(): void
    {
        $this->ensureAtendimentoIniciado();
        $this->validateOnly('emailRat');

        if (! $this->emailRat) {
            $this->addError('emailRat', 'Informe o e-mail para enviar a RAT.');

            return;
        }

        $ocorrencia = $this->ocorrencia->fresh(['prazo', 'colaborador', 'enderecoVinculado']);
        $pdfBytes = app(RenderRatPdfFromOcorrencia::class)($ocorrencia);

        $relativePath = 'ocorrencias/'.$ocorrencia->id.'/rat/RAT-'.$ocorrencia->id.'.pdf';
        Storage::disk('public')->put($relativePath, $pdfBytes);

        $ocorrencia->update([
            'email_rat' => $this->emailRat,
            'email_rat_enviado' => now(),
            'rat_pdf_path' => $relativePath,
        ]);

        Mail::to($this->emailRat)->send(new RatEnviada($ocorrencia->fresh(['colaborador', 'prazo', 'enderecoVinculado'])));

        unset($this->ocorrencia);

        $this->swalToastSuccess(SwalToast::successOptions('RAT enviada por e-mail com sucesso!'));
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

        Mail::to('gueberson@vbeton.com.br')
            ->cc('fabio@vbeton.com.br')
            ->send(new OcorrenciaConcluida($ocorrencia->fresh()));

        unset($this->ocorrencia);

        $this->swalToastSuccess(SwalToast::successOptions('Atendimento concluído! Aguardando revisão.'));
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
