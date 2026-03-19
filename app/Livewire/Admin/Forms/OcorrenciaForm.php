<?php

namespace App\Livewire\Admin\Forms;

use App\Enums\OcorrenciaStatus;
use App\Models\Ocorrencia;
use Illuminate\Validation\Rule;
use Livewire\Form;

class OcorrenciaForm extends Form
{
    public ?int $editingId = null;

    public string $numeroOcorrencia = '';

    public string $status = '';

    public string $titulo = '';

    public ?string $descricao = null;

    public string $abertura = '';

    public ?int $colaboradorId = null;

    public ?int $prazoId = null;

    public string $agencia = '';

    public ?string $endereco = null;

    public ?string $comentarios = null;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'numeroOcorrencia' => [
                'required',
                'integer',
                Rule::unique('ocorrencias', 'numero_ocorrencia')->ignore($this->editingId, 'numero_ocorrencia'),
            ],
            'status' => ['required', Rule::enum(OcorrenciaStatus::class)],
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'abertura' => ['required', 'date'],
            'colaboradorId' => ['nullable', 'exists:colaboradores,id'],
            'prazoId' => ['nullable', 'exists:prazos,id'],
            'agencia' => ['required', 'string', 'max:255'],
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
            'numeroOcorrencia.required' => 'O nº da ocorrência é obrigatório.',
            'numeroOcorrencia.integer' => 'O nº da ocorrência deve ser um número inteiro.',
            'numeroOcorrencia.unique' => 'Este nº de ocorrência já está cadastrado.',
            'status.required' => 'O status é obrigatório.',
            'status.enum' => 'O status selecionado é inválido.',
            'titulo.required' => 'O título é obrigatório.',
            'titulo.max' => 'O título não pode ter mais de 255 caracteres.',
            'abertura.required' => 'A data de abertura é obrigatória.',
            'abertura.date' => 'A data de abertura deve ser uma data válida.',
            'colaboradorId.exists' => 'O colaborador selecionado não existe.',
            'prazoId.exists' => 'A categoria selecionada não existe.',
            'agencia.required' => 'A agência é obrigatória.',
            'agencia.max' => 'A agência não pode ter mais de 255 caracteres.',
        ];
    }

    public function setForCreate(): void
    {
        $this->reset();
        $this->status = OcorrenciaStatus::Aberto->value;
        $this->abertura = now()->format('Y-m-d');
    }

    public function setFromOcorrencia(Ocorrencia $ocorrencia): void
    {
        $this->editingId = $ocorrencia->numero_ocorrencia;
        $this->numeroOcorrencia = (string) $ocorrencia->numero_ocorrencia;
        $this->status = $ocorrencia->status->value;
        $this->titulo = $ocorrencia->titulo;
        $this->descricao = $ocorrencia->descricao;
        $this->abertura = $ocorrencia->abertura->format('Y-m-d');
        $this->colaboradorId = $ocorrencia->colaborador_id;
        $this->prazoId = $ocorrencia->prazo_id;
        $this->agencia = $ocorrencia->agencia;
        $this->endereco = $ocorrencia->endereco;
        $this->comentarios = $ocorrencia->comentarios;
    }

    /**
     * @return array<string, mixed>
     */
    public function toData(): array
    {
        return [
            'numero_ocorrencia' => (int) $this->numeroOcorrencia,
            'status' => $this->status,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'abertura' => $this->abertura,
            'colaborador_id' => $this->colaboradorId,
            'prazo_id' => $this->prazoId,
            'agencia' => $this->agencia,
            'endereco' => $this->endereco,
            'comentarios' => $this->comentarios,
        ];
    }
}
