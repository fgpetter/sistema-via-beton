<?php

namespace App\Livewire\Prestador;

use App\Actions\Programadas\RenderRatPdfFromProgramada;
use App\Enums\ProgramadaStatus;
use App\Enums\TipoImagemOcorrencia;
use App\Jobs\ProcessarImagemProgramada;
use App\Mail\ProgramadaConcluida;
use App\Mail\RatProgramadaEnviada;
use App\Models\Programada;
use App\Models\ProgramadaImagem;
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
class ProgramadaAtendimentoDetalhe extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    #[Locked]
    public int $programadaId;

    public ?string $comentariosPrestador = null;

    public ?string $emailRat = null;

    public ?string $dataChegada = null;

    public ?string $dataSaida = null;

    public $fotoUpload;

    public ?int $uploadingPar = null;

    public ?string $uploadingTipo = null;

    public function mount(int $programadaId): void
    {
        $this->programadaId = $programadaId;
        $programada = $this->ensureUserOwnsProgramada();
        $this->comentariosPrestador = $programada->comentarios_prestador;
        $this->emailRat = $programada->email_rat;
        $this->dataChegada = $programada->data_chegada?->format('Y-m-d');
        $this->dataSaida = $programada->data_saida?->format('Y-m-d');
    }

    protected function rules(): array
    {
        return [
            'comentariosPrestador' => ['nullable', 'string'],
            'emailRat' => ['nullable', 'email', 'max:255'],
            'dataChegada' => ['nullable', 'date'],
            'dataSaida' => ['nullable', 'date'],
            'fotoUpload' => ['nullable', 'image', 'max:5120'],
        ];
    }

    protected function messages(): array
    {
        return [
            'emailRat.email' => 'O e-mail informado não é válido.',
            'emailRat.max' => 'O e-mail não pode ter mais de 255 caracteres.',
            'dataChegada.date' => 'A data de chegada deve ser uma data válida.',
            'dataSaida.date' => 'A data de saída deve ser uma data válida.',
            'fotoUpload.image' => 'O arquivo deve ser uma imagem.',
            'fotoUpload.max' => 'A imagem deve ter no máximo 5MB.',
        ];
    }

    #[Computed]
    public function programada(): Programada
    {
        return Programada::with(['colaborador', 'imagens', 'imagensAntes', 'imagensDepois', 'concluidoPor', 'enderecoVinculado'])
            ->findOrFail($this->programadaId);
    }

    public function iniciarAtendimento(): void
    {
        $programada = $this->ensureUserOwnsProgramada();

        if ($programada->atendimentoIniciado() || ! in_array($programada->status, [ProgramadaStatus::Aberto, ProgramadaStatus::Andamento])) {
            abort(403, 'Não é possível iniciar este atendimento.');
        }

        $payload = [
            'status' => ProgramadaStatus::Andamento,
        ];

        if ($programada->data_chegada === null) {
            $payload['data_chegada'] = now();
        }

        $programada->update($payload);
        $this->dataChegada = $programada->fresh()->data_chegada?->format('Y-m-d');
        unset($this->programada);

        $this->swalToastSuccess(SwalToast::successOptions('Atendimento iniciado!'));
    }

    #[Computed]
    public function fotoPares(): array
    {
        $maxPar = (int) $this->programada->imagens->max('par');

        return $this->programada->fotoPares(max(1, $maxPar + 1));
    }

    public function updatedFotoUpload(): void
    {
        if (! $this->fotoUpload || $this->uploadingPar === null || ! $this->uploadingTipo) {
            return;
        }

        $this->ensureUserOwnsProgramada();
        $this->validateOnly('fotoUpload');

        $tipo = TipoImagemOcorrencia::from($this->uploadingTipo);
        if ($tipo === TipoImagemOcorrencia::Depois && ! $this->programada->imagens()->where('par', $this->uploadingPar)->where('tipo', TipoImagemOcorrencia::Antes)->exists()) {
            abort(403, 'Envie uma foto Antes para este par primeiro.');
        }
        $path = $this->fotoUpload->store("programadas/{$this->programadaId}/{$tipo->value}", 'public');

        $imagem = ProgramadaImagem::create([
            'programada_id' => $this->programadaId,
            'tipo' => $tipo,
            'par' => $this->uploadingPar,
            'path' => $path,
        ]);

        ProcessarImagemProgramada::dispatch($imagem);

        $this->reset(['fotoUpload', 'uploadingPar', 'uploadingTipo']);
        unset($this->programada, $this->fotoPares);

        $this->swalToastSuccess(SwalToast::successOptions('Foto enviada!'));
    }

    public function removerImagem(int $imagemId): void
    {
        $this->ensureAtendimentoIniciado();

        $imagem = ProgramadaImagem::where('programada_id', $this->programadaId)
            ->findOrFail($imagemId);

        Storage::disk('public')->delete($imagem->path);
        $imagem->delete();
        unset($this->programada, $this->fotoPares);

        $this->swalToastSuccess(SwalToast::successOptions('Foto removida!'));
    }

    public function salvarComentarios(): void
    {
        $this->ensureAtendimentoIniciado();
        $this->validateOnly('comentariosPrestador');
        $this->programada->update(['comentarios_prestador' => $this->comentariosPrestador]);

        $this->swalToastSuccess(SwalToast::successOptions('Comentários salvos!'));
    }

    public function updatedDataChegada(): void
    {
        $this->persistirDataAtendimento('data_chegada', $this->dataChegada);
    }

    public function updatedDataSaida(): void
    {
        $this->persistirDataAtendimento('data_saida', $this->dataSaida);
    }

    protected function persistirDataAtendimento(string $coluna, ?string $valor): void
    {
        $programada = $this->ensureAtendimentoIniciado();

        if ($programada->status !== ProgramadaStatus::Andamento) {
            abort(403, 'Não é possível alterar as datas deste atendimento.');
        }

        $propriedade = $coluna === 'data_chegada' ? 'dataChegada' : 'dataSaida';

        if (blank($valor)) {
            $this->{$propriedade} = $programada->{$coluna}?->format('Y-m-d');

            return;
        }

        $this->validateOnly($propriedade);
        $programada->update([$coluna => $valor]);
        unset($this->programada);
        $this->{$propriedade} = $programada->fresh()->{$coluna}?->format('Y-m-d');
    }

    public function enviarEmail(): void
    {
        $this->ensureAtendimentoIniciado();
        $this->validateOnly('emailRat');

        if (! $this->emailRat) {
            $this->addError('emailRat', 'Informe o e-mail para enviar a RAT.');

            return;
        }

        $programada = $this->programada->fresh(['colaborador', 'enderecoVinculado', 'responsavelEngenharia', 'disciplina', 'subdisciplina1', 'subdisciplina2', 'subdisciplina3', 'subdisciplina4', 'subdisciplina5', 'subdisciplina6']);
        $primeiroEnvio = $programada->email_rat_enviado === null;

        if ($primeiroEnvio && $programada->data_saida === null) {
            $programada->data_saida = now();
        }

        $pdfBytes = app(RenderRatPdfFromProgramada::class)($programada);

        $relativePath = 'programadas/'.$programada->id.'/rat/RAT-'.$programada->id.'.pdf';
        Storage::disk('public')->put($relativePath, $pdfBytes);

        $dados = [
            'email_rat' => $this->emailRat,
            'email_rat_enviado' => now(),
            'rat_pdf_path' => $relativePath,
        ];

        if ($primeiroEnvio && $programada->data_saida !== null) {
            $dados['data_saida'] = $programada->data_saida;
        }

        $programada->update($dados);

        Mail::to($this->emailRat)->send(new RatProgramadaEnviada($programada->fresh(['colaborador', 'enderecoVinculado', 'responsavelEngenharia', 'disciplina', 'subdisciplina1', 'subdisciplina2', 'subdisciplina3', 'subdisciplina4', 'subdisciplina5', 'subdisciplina6'])));

        unset($this->programada);
        $this->dataSaida = $programada->fresh()->data_saida?->format('Y-m-d');

        $this->swalToastSuccess(SwalToast::successOptions('RAT enviada por e-mail com sucesso!'));
    }

    public function concluir(): void
    {
        $programada = $this->ensureAtendimentoIniciado();

        if (! $programada->podeConcluir()) {
            $this->swalToastWarning([
                'title' => 'Não é possível concluir',
                'text' => 'É necessário ao menos 1 foto de antes, 1 de depois e ter enviado o e-mail.',
                'showConfirmButton' => true,
                'position' => 'top-end',
            ]);

            return;
        }

        $programada->update([
            'status' => ProgramadaStatus::Revisar,
        ]);

        Mail::to('gueberson@vbeton.com.br')
            ->cc('fabio@vbeton.com.br')
            ->send(new ProgramadaConcluida($programada->fresh()));

        unset($this->programada);

        $this->swalToastSuccess(SwalToast::successOptions('Atendimento concluído! Aguardando revisão.'));
    }

    protected function ensureAtendimentoIniciado(): Programada
    {
        $programada = $this->ensureUserOwnsProgramada();

        if (! $programada->atendimentoIniciado()) {
            abort(403, 'O atendimento ainda não foi iniciado.');
        }

        return $programada;
    }

    protected function ensureUserOwnsProgramada(): Programada
    {
        /** @var User $user */
        $user = auth()->user();
        $colaborador = $user->colaborador;
        $programada = Programada::findOrFail($this->programadaId);

        if (! $colaborador || $programada->colaborador_id !== $colaborador->id) {
            abort(403, 'Você não tem permissão para acessar esta programada.');
        }

        return $programada;
    }

    public function render(): View
    {
        return view('livewire.prestador.programada-atendimento-detalhe');
    }
}
