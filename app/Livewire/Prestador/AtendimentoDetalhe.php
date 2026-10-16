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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use SweetAlert2\Laravel\Traits\WithSweetAlert;
use Throwable;

#[Layout('layouts.vertical')]
#[Title('Detalhes do Atendimento')]
class AtendimentoDetalhe extends Component
{
    use WithFileUploads {
        _startUpload as livewireStartUpload;
        _finishUpload as livewireFinishUpload;
        _uploadErrored as livewireUploadErrored;
    }
    use WithSweetAlert;

    #[Locked]
    public int $ocorrenciaId;

    public ?string $comentariosPrestador = null;

    public ?string $emailRat = null;

    public ?string $dataChegada = null;

    public ?string $dataSaida = null;

    public $fotoUpload;

    public ?int $uploadingPar = null;

    public ?string $uploadingTipo = null;

    public function mount(int $ocorrenciaId): void
    {
        $this->ocorrenciaId = $ocorrenciaId;
        $ocorrencia = $this->ensureUserOwnsOcorrencia();
        $this->comentariosPrestador = $ocorrencia->comentarios_prestador;
        $this->emailRat = $ocorrencia->email_rat;
        $this->dataChegada = $ocorrencia->data_chegada?->format('Y-m-d');
        $this->dataSaida = $ocorrencia->data_saida?->format('Y-m-d');
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

        $payload = [
            'status' => OcorrenciaStatus::Andamento,
        ];

        if ($ocorrencia->data_chegada === null) {
            $payload['data_chegada'] = now();
        }

        $ocorrencia->update($payload);
        $this->dataChegada = $ocorrencia->fresh()->data_chegada?->format('Y-m-d');
        unset($this->ocorrencia);

        $this->swalToastSuccess(SwalToast::successOptions('Atendimento iniciado!'));
    }

    #[Computed]
    public function fotoPares(): array
    {
        $maxPar = (int) $this->ocorrencia->imagens->max('par');

        return $this->ocorrencia->fotoPares(max(1, $maxPar + 1));
    }

    public function updatedUploadingTipo(): void
    {
        if ($this->uploadingPar === null || $this->uploadingTipo === null) {
            return;
        }

        $this->registrarUpload('slot_selecionado');
    }

    /**
     * @param  array<int, array<string, mixed>>  $fileInfo
     */
    public function _startUpload(string $name, array $fileInfo, bool $isMultiple): void
    {
        if ($name === 'fotoUpload') {
            $this->registrarUpload('inicio', [
                'arquivos' => collect($fileInfo)->map(fn (array $arquivo): array => [
                    'nome' => Str::limit((string) ($arquivo['name'] ?? ''), 180),
                    'tamanho' => (int) ($arquivo['size'] ?? 0),
                    'mime' => Str::limit((string) ($arquivo['type'] ?? ''), 80),
                ])->all(),
                'limites' => [
                    'upload_max_filesize' => ini_get('upload_max_filesize'),
                    'post_max_size' => ini_get('post_max_size'),
                ],
            ]);
        }

        $this->livewireStartUpload($name, $fileInfo, $isMultiple);
    }

    /**
     * @param  array<int, string>  $tmpPath
     */
    public function _finishUpload(string $name, array $tmpPath, bool $isMultiple, bool $append = true): void
    {
        if ($name === 'fotoUpload') {
            $this->registrarUpload('temporario_recebido');
        }

        try {
            $this->livewireFinishUpload($name, $tmpPath, $isMultiple, $append);
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            if ($name === 'fotoUpload') {
                $this->registrarUpload('erro_finalizar', [
                    'exception' => $e::class,
                    'message' => $e->getMessage(),
                ], 'error');
            }

            throw $e;
        }
    }

    public function _uploadErrored(string $name, ?string $errorsInJson, bool $isMultiple): void
    {
        if ($name === 'fotoUpload') {
            $this->registrarUpload('erro_servidor', [
                'erros' => $errorsInJson === null ? null : Str::limit($errorsInJson, 2000),
            ], 'error');
        }

        $this->livewireUploadErrored($name, $errorsInJson, $isMultiple);
    }

    /**
     * @param  array<string, mixed>  $detalhe
     */
    #[Renderless]
    public function registrarEventoUploadFoto(string $evento, array $detalhe = []): void
    {
        if (! in_array($evento, ['erro_cliente', 'cancelado'], true)) {
            return;
        }

        $this->ensureUserOwnsOcorrencia();

        $this->registrarUpload($evento, [
            'nome' => isset($detalhe['nome']) ? Str::limit((string) $detalhe['nome'], 180) : null,
            'tamanho' => isset($detalhe['tamanho']) ? (int) $detalhe['tamanho'] : null,
            'mime' => isset($detalhe['mime']) ? Str::limit((string) $detalhe['mime'], 80) : null,
            'online' => array_key_exists('online', $detalhe) ? (bool) $detalhe['online'] : null,
            'visivel' => isset($detalhe['visivel']) ? Str::limit((string) $detalhe['visivel'], 20) : null,
        ], $evento === 'cancelado' ? 'warning' : 'error');
    }

    public function updatedFotoUpload(): void
    {
        if (! $this->fotoUpload || $this->uploadingPar === null || ! $this->uploadingTipo) {
            $this->registrarUpload('interrompido', [
                'motivo' => 'estado_incompleto',
                'tem_arquivo' => (bool) $this->fotoUpload,
                'par' => $this->uploadingPar,
                'tipo' => $this->uploadingTipo,
            ], 'warning');

            return;
        }

        try {
            $this->ensureUserOwnsOcorrencia();
            $this->validateOnly('fotoUpload');

            $tipo = TipoImagemOcorrencia::from($this->uploadingTipo);
            $nome = $this->fotoUpload->getClientOriginalName();
            $tamanho = $this->fotoUpload->getSize();
            $mime = $this->fotoUpload->getMimeType();
            $path = $this->fotoUpload->store("ocorrencias/{$this->ocorrenciaId}/{$tipo->value}", 'public');

            $imagem = OcorrenciaImagem::create([
                'ocorrencia_id' => $this->ocorrenciaId,
                'tipo' => $tipo,
                'par' => $this->uploadingPar,
                'path' => $path,
            ]);

            ProcessarImagemOcorrencia::dispatch($imagem);

            $this->registrarUpload('salvo', [
                'imagem_id' => $imagem->id,
                'path' => $path,
                'nome' => $nome,
                'tamanho' => $tamanho,
                'mime' => $mime,
            ]);

            $this->reset(['fotoUpload', 'uploadingPar', 'uploadingTipo']);
            unset($this->ocorrencia, $this->fotoPares);

            $this->swalToastSuccess(SwalToast::successOptions('Foto enviada!'));
        } catch (ValidationException $e) {
            $this->registrarUpload('validacao', [
                'erros' => $e->errors(),
            ], 'warning');

            throw $e;
        } catch (Throwable $e) {
            $this->registrarUpload('excecao', [
                'exception' => $e::class,
                'message' => $e->getMessage(),
            ], 'error');

            throw $e;
        }
    }

    /**
     * @param  array<string, mixed>  $contexto
     */
    protected function registrarUpload(string $evento, array $contexto = [], string $nivel = 'info'): void
    {
        $contexto = array_merge([
            'ocorrencia_id' => $this->ocorrenciaId,
            'user_id' => auth()->id(),
            'par' => $this->uploadingPar,
            'tipo' => $this->uploadingTipo,
            'ip' => request()->ip(),
            'user_agent' => Str::limit((string) request()->userAgent(), 300),
        ], $contexto);

        $canal = Log::channel('upload_fotos');

        match ($nivel) {
            'warning' => $canal->warning($evento, $contexto),
            'error' => $canal->error($evento, $contexto),
            default => $canal->info($evento, $contexto),
        };
    }

    public function removerImagem(int $imagemId): void
    {
        $this->ensureAtendimentoIniciado();

        $imagem = OcorrenciaImagem::where('ocorrencia_id', $this->ocorrenciaId)
            ->findOrFail($imagemId);

        Storage::disk('public')->delete($imagem->path);
        $imagem->delete();
        unset($this->ocorrencia, $this->fotoPares);

        $this->swalToastSuccess(SwalToast::successOptions('Foto removida!'));
    }

    public function salvarComentarios(): void
    {
        $this->ensureAtendimentoIniciado();
        $this->validateOnly('comentariosPrestador');
        $this->ocorrencia->update(['comentarios_prestador' => $this->comentariosPrestador]);

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
        $ocorrencia = $this->ensureAtendimentoIniciado();

        if ($ocorrencia->status !== OcorrenciaStatus::Andamento) {
            abort(403, 'Não é possível alterar as datas deste atendimento.');
        }

        $propriedade = $coluna === 'data_chegada' ? 'dataChegada' : 'dataSaida';

        if (blank($valor)) {
            $this->{$propriedade} = $ocorrencia->{$coluna}?->format('Y-m-d');

            return;
        }

        $this->validateOnly($propriedade);
        $ocorrencia->update([$coluna => $valor]);
        unset($this->ocorrencia);
        $this->{$propriedade} = $ocorrencia->fresh()->{$coluna}?->format('Y-m-d');
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
        $primeiroEnvio = $ocorrencia->email_rat_enviado === null;

        if ($primeiroEnvio && $ocorrencia->data_saida === null) {
            $ocorrencia->data_saida = now();
        }

        $pdfBytes = app(RenderRatPdfFromOcorrencia::class)($ocorrencia);

        $relativePath = 'ocorrencias/'.$ocorrencia->id.'/rat/RAT-'.$ocorrencia->id.'.pdf';
        Storage::disk('public')->put($relativePath, $pdfBytes);

        $dados = [
            'email_rat' => $this->emailRat,
            'email_rat_enviado' => now(),
            'rat_pdf_path' => $relativePath,
        ];

        if ($primeiroEnvio && $ocorrencia->data_saida !== null) {
            $dados['data_saida'] = $ocorrencia->data_saida;
        }

        $ocorrencia->update($dados);

        Mail::to($this->emailRat)->send(new RatEnviada($ocorrencia->fresh(['colaborador', 'prazo', 'enderecoVinculado'])));

        unset($this->ocorrencia);
        $this->dataSaida = $ocorrencia->fresh()->data_saida?->format('Y-m-d');

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
