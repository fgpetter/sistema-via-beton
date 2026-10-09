<?php

namespace App\Livewire\Admin\Forms;

use App\Enums\ContratoSolucionador;
use App\Enums\OcorrenciaStatus;
use App\Enums\TipoColaborador;
use App\Models\Colaborador;
use App\Models\Ocorrencia;
use Illuminate\Validation\Rule;
use Livewire\Form;

class OcorrenciaForm extends Form
{
    public ?int $editingId = null;

    public string $status = '';

    public string $titulo = '';

    public ?string $descricao = null;

    public string $abertura = '';

    public ?int $colaboradorId = null;

    public ?string $prestadorNome = null;

    public ?int $prazoId = null;

    public ?int $responsavelEngenhariaId = null;

    public ?int $disciplinaId = null;

    public ?int $subdisciplina1Id = null;

    public ?int $subdisciplina2Id = null;

    public ?int $subdisciplina3Id = null;

    public ?int $subdisciplina4Id = null;

    public ?int $subdisciplina5Id = null;

    public ?int $subdisciplina6Id = null;

    public string $agencia = '';

    public string $contratoLabel = '';

    public ?string $endereco = null;

    public ?string $dataChegada = null;

    public ?string $dataSaida = null;

    public ?string $comentarios = null;

    public ?string $comentarios_prestador = null;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(OcorrenciaStatus::class)],
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'abertura' => ['required', 'date'],
            'colaboradorId' => ['nullable', 'exists:colaboradores,id'],
            'prestadorNome' => ['nullable', 'string', 'max:255'],
            'prazoId' => ['nullable', 'exists:prazos,id'],
            'responsavelEngenhariaId' => [
                'nullable',
                'integer',
                Rule::exists('responsavel_engenharia', 'id')->where(function ($query) {
                    $vinculadoId = $this->responsavelEngenhariaIdVinculado();

                    if ($vinculadoId === null || (int) $this->responsavelEngenhariaId !== (int) $vinculadoId) {
                        $query->whereNull('deleted_at');
                    }
                }),
            ],
            'disciplinaId' => [
                'nullable',
                'integer',
                Rule::exists('disciplinas', 'id')->where('subdisciplina', 0),
            ],
            'subdisciplina1Id' => [
                'nullable',
                'integer',
                Rule::exists('disciplinas', 'id')->where('subdisciplina', 1),
            ],
            'subdisciplina2Id' => [
                'nullable',
                'integer',
                Rule::exists('disciplinas', 'id')->where('subdisciplina', 1),
            ],
            'subdisciplina3Id' => [
                'nullable',
                'integer',
                Rule::exists('disciplinas', 'id')->where('subdisciplina', 1),
            ],
            'subdisciplina4Id' => [
                'nullable',
                'integer',
                Rule::exists('disciplinas', 'id')->where('subdisciplina', 1),
            ],
            'subdisciplina5Id' => [
                'nullable',
                'integer',
                Rule::exists('disciplinas', 'id')->where('subdisciplina', 1),
            ],
            'subdisciplina6Id' => [
                'nullable',
                'integer',
                Rule::exists('disciplinas', 'id')->where('subdisciplina', 1),
            ],
            'agencia' => ['required', 'string', 'max:255'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'dataChegada' => ['nullable', 'date'],
            'dataSaida' => ['nullable', 'date'],
            'comentarios' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'status.required' => 'O status é obrigatório.',
            'status.enum' => 'O status selecionado é inválido.',
            'titulo.required' => 'O título é obrigatório.',
            'titulo.max' => 'O título não pode ter mais de 255 caracteres.',
            'abertura.required' => 'A data de abertura é obrigatória.',
            'abertura.date' => 'A data de abertura deve ser uma data válida.',
            'colaboradorId.exists' => 'O colaborador selecionado não existe.',
            'prestadorNome.max' => 'O nome do prestador não pode ter mais de 255 caracteres.',
            'prazoId.exists' => 'A categoria selecionada não existe.',
            'responsavelEngenhariaId.exists' => 'O responsável de engenharia selecionado é inválido.',
            'disciplinaId.exists' => 'A disciplina selecionada é inválida.',
            'subdisciplina1Id.exists' => 'A subdisciplina 1 selecionada é inválida.',
            'subdisciplina2Id.exists' => 'A subdisciplina 2 selecionada é inválida.',
            'subdisciplina3Id.exists' => 'A subdisciplina 3 selecionada é inválida.',
            'subdisciplina4Id.exists' => 'A subdisciplina 4 selecionada é inválida.',
            'subdisciplina5Id.exists' => 'A subdisciplina 5 selecionada é inválida.',
            'subdisciplina6Id.exists' => 'A subdisciplina 6 selecionada é inválida.',
            'agencia.required' => 'A agência é obrigatória.',
            'agencia.max' => 'A agência não pode ter mais de 255 caracteres.',
            'dataChegada.date' => 'A data de chegada deve ser uma data válida.',
            'dataSaida.date' => 'A data de saída deve ser uma data válida.',
        ];
    }

    public function validate($rules = null, $messages = [], $attributes = []): void
    {
        $this->dataChegada = blank($this->dataChegada) ? null : $this->dataChegada;
        $this->dataSaida = blank($this->dataSaida) ? null : $this->dataSaida;
        $this->prestadorNome = blank($this->prestadorNome) ? null : trim((string) $this->prestadorNome);

        parent::validate($rules, $messages, $attributes);
    }

    public function setForCreate(): void
    {
        $this->reset();
        $this->status = OcorrenciaStatus::Aberto->value;
        $this->abertura = now()->format('Y-m-d');
    }

    public function setFromOcorrencia(Ocorrencia $ocorrencia): void
    {
        $this->editingId = $ocorrencia->id;
        $this->status = $ocorrencia->status->value;
        $this->titulo = $ocorrencia->titulo ?? '';
        $this->descricao = $ocorrencia->descricao;
        $this->abertura = $ocorrencia->abertura->format('Y-m-d');
        $this->colaboradorId = $ocorrencia->colaborador_id;
        $this->prestadorNome = $ocorrencia->prestador_nome;
        $this->prazoId = $ocorrencia->prazo_id;
        $this->responsavelEngenhariaId = $ocorrencia->responsavel_engenharia_id;
        $this->disciplinaId = $ocorrencia->disciplina_id;
        $this->subdisciplina1Id = $ocorrencia->subdisciplina_1_id;
        $this->subdisciplina2Id = $ocorrencia->subdisciplina_2_id;
        $this->subdisciplina3Id = $ocorrencia->subdisciplina_3_id;
        $this->subdisciplina4Id = $ocorrencia->subdisciplina_4_id;
        $this->subdisciplina5Id = $ocorrencia->subdisciplina_5_id;
        $this->subdisciplina6Id = $ocorrencia->subdisciplina_6_id;
        $this->agencia = $ocorrencia->agencia ?? '';
        $this->contratoLabel = ContratoSolucionador::tryFrom((string) $ocorrencia->contrato)?->label() ?? '';
        $this->endereco = $ocorrencia->endereco;
        $this->dataChegada = $ocorrencia->data_chegada?->format('Y-m-d');
        $this->dataSaida = $ocorrencia->data_saida?->format('Y-m-d');
        $this->comentarios = $ocorrencia->comentarios;
        $this->comentarios_prestador = $ocorrencia->comentarios_prestador;
    }

    /**
     * @return array<string, mixed>
     */
    public function toData(?Ocorrencia $ocorrencia = null): array
    {
        $data = [
            'status' => $this->status,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'abertura' => $this->abertura,
            'colaborador_id' => $this->colaboradorId,
            'prestador_nome' => $this->resolvedPrestadorNome(),
            'prazo_id' => $this->prazoId,
            'responsavel_engenharia_id' => blank($this->responsavelEngenhariaId)
                ? null
                : (int) $this->responsavelEngenhariaId,
            'disciplina_id' => $this->disciplinaId,
            'subdisciplina_1_id' => $this->subdisciplina1Id,
            'subdisciplina_2_id' => $this->subdisciplina2Id,
            'subdisciplina_3_id' => $this->subdisciplina3Id,
            'subdisciplina_4_id' => $this->subdisciplina4Id,
            'subdisciplina_5_id' => $this->subdisciplina5Id,
            'subdisciplina_6_id' => $this->subdisciplina6Id,
            'agencia' => $this->agencia,
            'endereco_id' => Ocorrencia::resolverEnderecoId($this->agencia),
            'endereco' => $this->endereco,
            'comentarios' => $this->comentarios,
        ];

        $data['data_chegada'] = $this->dataChegada ?? $ocorrencia?->data_chegada;
        $data['data_saida'] = $this->dataSaida ?? $ocorrencia?->data_saida;

        if ($data['data_chegada'] && $data['status'] === OcorrenciaStatus::Aberto->value) {
            $data['status'] = OcorrenciaStatus::Andamento->value;
        }

        return $data;
    }

    protected function responsavelEngenhariaIdVinculado(): ?int
    {
        if (! $this->editingId) {
            return null;
        }

        return Ocorrencia::query()->whereKey($this->editingId)->value('responsavel_engenharia_id');
    }

    protected function resolvedPrestadorNome(): ?string
    {
        if (! $this->editingId) {
            return null;
        }

        if ($this->colaboradorId === null) {
            return null;
        }

        $colaborador = Colaborador::query()->find($this->colaboradorId);

        if ($colaborador?->tipo !== TipoColaborador::Administrativos) {
            return null;
        }

        return blank($this->prestadorNome) ? null : (string) $this->prestadorNome;
    }
}
