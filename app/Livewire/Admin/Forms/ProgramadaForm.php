<?php

namespace App\Livewire\Admin\Forms;

use App\Enums\ProgramadaStatus;
use App\Enums\ProgramadaTipo;
use App\Enums\TipoColaborador;
use App\Models\Colaborador;
use App\Models\Programada;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ProgramadaForm extends Form
{
    public ?int $editingId = null;

    public string $status = '';

    public string $tipo = '';

    public string $titulo = '';

    public ?string $descricao = null;

    public string $abertura = '';

    public ?int $colaboradorId = null;

    public ?string $prestadorNome = null;

    public ?int $responsavelEngenhariaId = null;

    public ?int $disciplinaId = null;

    public ?int $subdisciplina1Id = null;

    public ?int $subdisciplina2Id = null;

    public ?int $subdisciplina3Id = null;

    public ?int $subdisciplina4Id = null;

    public ?int $subdisciplina5Id = null;

    public ?int $subdisciplina6Id = null;

    public string $agencia = '';

    public ?string $endereco = null;

    public ?string $dataChegada = null;

    public ?string $dataSaida = null;

    public ?string $comentarios = null;

    public function rules(): array
    {
        $rules = [
            'status' => ['required', Rule::enum(ProgramadaStatus::class)],
            'tipo' => ['required', Rule::enum(ProgramadaTipo::class)],
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'abertura' => ['required', 'date'],
            'colaboradorId' => ['nullable', 'exists:colaboradores,id'],
            'prestadorNome' => ['nullable', 'string', 'max:255'],
            'responsavelEngenhariaId' => [
                'nullable', 'integer',
                Rule::exists('responsavel_engenharia', 'id')->where(function ($query) {
                    $id = $this->responsavelEngenhariaIdVinculado();
                    if ($id === null || (int) $this->responsavelEngenhariaId !== (int) $id) {
                        $query->whereNull('deleted_at');
                    }
                }),
            ],
            'disciplinaId' => ['nullable', 'integer', Rule::exists('disciplinas', 'id')->where('subdisciplina', false)],
            'agencia' => ['required', 'string', 'max:255'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'dataChegada' => ['nullable', 'date'],
            'dataSaida' => ['nullable', 'date'],
            'comentarios' => ['nullable', 'string'],
        ];
        foreach (range(1, 6) as $numero) {
            $rules["subdisciplina{$numero}Id"] = ['nullable', 'integer', Rule::exists('disciplinas', 'id')->where('subdisciplina', true)];
        }

        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'tipo.required' => 'O tipo é obrigatório.',
            'tipo.enum' => 'O tipo selecionado é inválido.',
            'status.required' => 'O status é obrigatório.',
            'status.enum' => 'O status selecionado é inválido.',
            'titulo.required' => 'O título é obrigatório.',
            'abertura.required' => 'A data de abertura é obrigatória.',
            'colaboradorId.exists' => 'O colaborador selecionado não existe.',
            'responsavelEngenhariaId.exists' => 'O responsável de engenharia selecionado é inválido.',
            'disciplinaId.exists' => 'A disciplina selecionada é inválida.',
            'agencia.required' => 'A agência é obrigatória.',
            'agencia.max' => 'A agência não pode ter mais de 255 caracteres.',
            'dataChegada.date' => 'A data de chegada deve ser válida.',
            'dataSaida.date' => 'A data de saída deve ser válida.',
            'prestadorNome.max' => 'O nome do prestador não pode ter mais de 255 caracteres.',
        ];
        foreach (range(1, 6) as $numero) {
            $messages["subdisciplina{$numero}Id.exists"] = "A subdisciplina {$numero} selecionada é inválida.";
        }

        return $messages;
    }

    public function validate($rules = null, $messages = [], $attributes = []): void
    {
        $this->dataChegada = blank($this->dataChegada) ? null : $this->dataChegada;
        $this->dataSaida = blank($this->dataSaida) ? null : $this->dataSaida;
        $this->prestadorNome = blank($this->prestadorNome) ? null : trim($this->prestadorNome);
        parent::validate($rules, $messages, $attributes);
    }

    public function setForCreate(): void
    {
        $this->reset();
        $this->status = ProgramadaStatus::Aberto->value;
        $this->abertura = now()->format('Y-m-d');
    }

    public function setFromProgramada(Programada $programada): void
    {
        $this->editingId = $programada->id;
        $this->status = $programada->status->value;
        $this->tipo = $programada->tipo->value;
        $this->titulo = $programada->titulo;
        $this->descricao = $programada->descricao;
        $this->abertura = $programada->abertura->format('Y-m-d');
        $this->colaboradorId = $programada->colaborador_id;
        $this->prestadorNome = $programada->prestador_nome;
        $this->responsavelEngenhariaId = $programada->responsavel_engenharia_id;
        $this->disciplinaId = $programada->disciplina_id;
        foreach (range(1, 6) as $numero) {
            $this->{"subdisciplina{$numero}Id"} = $programada->{"subdisciplina_{$numero}_id"};
        }
        $this->agencia = $programada->agencia;
        $this->endereco = $programada->endereco;
        $this->dataChegada = $programada->data_chegada?->format('Y-m-d');
        $this->dataSaida = $programada->data_saida?->format('Y-m-d');
        $this->comentarios = $programada->comentarios;
    }

    public function toData(?Programada $programada = null): array
    {
        $data = [
            'status' => $this->status,
            'tipo' => $this->tipo,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'abertura' => $this->abertura,
            'colaborador_id' => $this->colaboradorId,
            'prestador_nome' => $this->resolvedPrestadorNome(),
            'responsavel_engenharia_id' => blank($this->responsavelEngenhariaId) ? null : (int) $this->responsavelEngenhariaId,
            'disciplina_id' => $this->disciplinaId,
            'agencia' => $this->agencia,
            'endereco_id' => Programada::resolverEnderecoId($this->agencia),
            'endereco' => $this->endereco,
            'comentarios' => $this->comentarios,
        ];
        foreach (range(1, 6) as $numero) {
            $data["subdisciplina_{$numero}_id"] = $this->{"subdisciplina{$numero}Id"};
        }
        if ($this->dataChegada !== null && $this->status === ProgramadaStatus::Aberto->value) {
            $data['status'] = ProgramadaStatus::Andamento->value;
        }
        if ($this->dataChegada !== null) {
            $data['data_chegada'] = $this->dataChegada;
        } elseif ($programada?->data_chegada !== null) {
            $data['data_chegada'] = $programada->data_chegada;
        }
        if ($this->dataSaida !== null) {
            $data['data_saida'] = $this->dataSaida;
        } elseif ($programada?->data_saida !== null) {
            $data['data_saida'] = $programada->data_saida;
        }

        return $data;
    }

    private function resolvedPrestadorNome(): ?string
    {
        if (! $this->editingId || ! $this->colaboradorId) {
            return null;
        }
        $colaborador = Colaborador::find($this->colaboradorId);

        return $colaborador?->tipo === TipoColaborador::Administrativos ? $this->prestadorNome : null;
    }

    private function responsavelEngenhariaIdVinculado(): ?int
    {
        return $this->editingId
            ? Programada::query()->whereKey($this->editingId)->value('responsavel_engenharia_id')
            : null;
    }
}
