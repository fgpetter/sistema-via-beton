<?php

namespace App\Livewire\Admin\Forms;

use App\Enums\ProgramadaStatus;
use App\Enums\ProgramadaTipo;
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

    public string $agencia = '';

    public ?int $responsavelEngenhariaId = null;

    public ?string $endereco = null;

    public ?string $comentarios = null;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(ProgramadaStatus::class)],
            'tipo' => ['required', Rule::enum(ProgramadaTipo::class)],
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'abertura' => ['required', 'date'],
            'colaboradorId' => ['nullable', 'exists:colaboradores,id'],
            'agencia' => ['required', 'string', 'max:255'],
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
            'endereco' => ['nullable', 'string', 'max:255'],
            'comentarios' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'tipo.required' => 'O tipo é obrigatório.',
            'tipo.enum' => 'O tipo selecionado é inválido.',
            'status.required' => 'O status é obrigatório.',
            'status.enum' => 'O status selecionado é inválido.',
            'titulo.required' => 'O título é obrigatório.',
            'titulo.max' => 'O título não pode ter mais de 255 caracteres.',
            'abertura.required' => 'A data de abertura é obrigatória.',
            'abertura.date' => 'A data de abertura deve ser uma data válida.',
            'colaboradorId.exists' => 'O colaborador selecionado não existe.',
            'agencia.required' => 'A agência é obrigatória.',
            'agencia.max' => 'A agência não pode ter mais de 255 caracteres.',
            'responsavelEngenhariaId.exists' => 'O responsável de engenharia selecionado é inválido.',
        ];
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
        $this->agencia = $programada->agencia;
        $this->responsavelEngenhariaId = $programada->responsavel_engenharia_id;
        $this->endereco = $programada->endereco;
        $this->comentarios = $programada->comentarios;
    }

    /**
     * @return array<string, mixed>
     */
    public function toData(): array
    {
        return [
            'status' => $this->status,
            'tipo' => $this->tipo,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'abertura' => $this->abertura,
            'colaborador_id' => $this->colaboradorId,
            'agencia' => $this->agencia,
            'responsavel_engenharia_id' => blank($this->responsavelEngenhariaId)
                ? null
                : (int) $this->responsavelEngenhariaId,
            'endereco_id' => Programada::resolverEnderecoId($this->agencia),
            'endereco' => $this->endereco,
            'comentarios' => $this->comentarios,
        ];
    }

    protected function responsavelEngenhariaIdVinculado(): ?int
    {
        if (! $this->editingId) {
            return null;
        }

        return Programada::query()->whereKey($this->editingId)->value('responsavel_engenharia_id');
    }
}
