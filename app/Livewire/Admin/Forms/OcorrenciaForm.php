<?php

namespace App\Livewire\Admin\Forms;

use App\Enums\OcorrenciaStatus;
use App\Models\Ocorrencia;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class OcorrenciaForm extends Form
{
    public ?int $editingId = null;

    public string $status = '';

    public string $titulo = '';

    public ?string $descricao = null;

    public string $abertura = '';

    public ?int $colaboradorId = null;

    public ?int $prazoId = null;

    public ?int $responsavelEngenhariaId = null;

    public ?int $disciplinaId = null;

    public ?int $subdisciplina1Id = null;

    public ?int $subdisciplina2Id = null;

    public ?int $subdisciplina3Id = null;

    public string $agencia = '';

    public ?string $endereco = null;

    public ?string $datahoraChegada = null;

    public ?string $datahoraSaida = null;

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
            'agencia' => ['required', 'string', 'max:255'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'datahoraChegada' => ['nullable', 'date'],
            'datahoraSaida' => ['nullable', 'date'],
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
            'prazoId.exists' => 'A categoria selecionada não existe.',
            'responsavelEngenhariaId.exists' => 'O responsável de engenharia selecionado é inválido.',
            'disciplinaId.exists' => 'A disciplina selecionada é inválida.',
            'subdisciplina1Id.exists' => 'A subdisciplina 1 selecionada é inválida.',
            'subdisciplina2Id.exists' => 'A subdisciplina 2 selecionada é inválida.',
            'subdisciplina3Id.exists' => 'A subdisciplina 3 selecionada é inválida.',
            'agencia.required' => 'A agência é obrigatória.',
            'agencia.max' => 'A agência não pode ter mais de 255 caracteres.',
            'datahoraChegada.date' => 'A data/hora de chegada deve ser uma data válida.',
            'datahoraSaida.date' => 'A data/hora de saída deve ser uma data válida.',
        ];
    }

    public function validate($rules = null, $messages = [], $attributes = []): void
    {
        $this->datahoraChegada = blank($this->datahoraChegada) ? null : $this->datahoraChegada;
        $this->datahoraSaida = blank($this->datahoraSaida) ? null : $this->datahoraSaida;

        parent::validate($rules, $messages, $attributes);

        $ids = array_values(array_filter([
            $this->disciplinaId,
            $this->subdisciplina1Id,
            $this->subdisciplina2Id,
            $this->subdisciplina3Id,
        ], fn ($id) => $id !== null));

        if (count($ids) !== count(array_unique($ids))) {
            $this->addError('disciplinaId', 'Não é permitido repetir a mesma disciplina ou subdisciplina.');

            throw ValidationException::withMessages([
                $this->getPropertyName().'.disciplinaId' => [
                    'Não é permitido repetir a mesma disciplina ou subdisciplina.',
                ],
            ]);
        }
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
        $this->prazoId = $ocorrencia->prazo_id;
        $this->responsavelEngenhariaId = $ocorrencia->responsavel_engenharia_id;
        $this->disciplinaId = $ocorrencia->disciplina_id;
        $this->subdisciplina1Id = $ocorrencia->subdisciplina_1_id;
        $this->subdisciplina2Id = $ocorrencia->subdisciplina_2_id;
        $this->subdisciplina3Id = $ocorrencia->subdisciplina_3_id;
        $this->agencia = $ocorrencia->agencia ?? '';
        $this->endereco = $ocorrencia->endereco;
        $this->datahoraChegada = $ocorrencia->datahora_chegada?->format('Y-m-d\TH:i');
        $this->datahoraSaida = $ocorrencia->datahora_saida?->format('Y-m-d\TH:i');
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
            'prazo_id' => $this->prazoId,
            'responsavel_engenharia_id' => blank($this->responsavelEngenhariaId)
                ? null
                : (int) $this->responsavelEngenhariaId,
            'disciplina_id' => $this->disciplinaId,
            'subdisciplina_1_id' => $this->subdisciplina1Id,
            'subdisciplina_2_id' => $this->subdisciplina2Id,
            'subdisciplina_3_id' => $this->subdisciplina3Id,
            'agencia' => $this->agencia,
            'endereco_id' => Ocorrencia::resolverEnderecoId($this->agencia),
            'endereco' => $this->endereco,
            'comentarios' => $this->comentarios,
        ];

        if ($ocorrencia?->podeEditarDatahorasAtendimento()) {
            $data['datahora_chegada'] = $this->datahoraChegada;
            $data['datahora_saida'] = $this->datahoraSaida;
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
}
