<?php

namespace App\Livewire\Admin\Forms;

use App\Enums\PreventivaStatus;
use App\Models\Preventiva;
use Illuminate\Validation\Rule;
use Livewire\Form;

class PreventivaForm extends Form
{
    public ?int $editingId = null;

    public string $status = '';

    public string $titulo = '';

    public ?string $descricao = null;

    public string $abertura = '';

    public ?int $colaboradorId = null;

    public string $agencia = '';

    public ?string $endereco = null;

    public ?string $comentarios = null;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(PreventivaStatus::class)],
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'abertura' => ['required', 'date'],
            'colaboradorId' => ['nullable', 'exists:colaboradores,id'],
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
            'status.required' => 'O status é obrigatório.',
            'status.enum' => 'O status selecionado é inválido.',
            'titulo.required' => 'O título é obrigatório.',
            'titulo.max' => 'O título não pode ter mais de 255 caracteres.',
            'abertura.required' => 'A data de abertura é obrigatória.',
            'abertura.date' => 'A data de abertura deve ser uma data válida.',
            'colaboradorId.exists' => 'O colaborador selecionado não existe.',
            'agencia.required' => 'A agência é obrigatória.',
            'agencia.max' => 'A agência não pode ter mais de 255 caracteres.',
        ];
    }

    public function setForCreate(): void
    {
        $this->reset();
        $this->status = PreventivaStatus::Aberto->value;
        $this->abertura = now()->format('Y-m-d');
    }

    public function setFromPreventiva(Preventiva $preventiva): void
    {
        $this->editingId = $preventiva->id;
        $this->status = $preventiva->status->value;
        $this->titulo = $preventiva->titulo;
        $this->descricao = $preventiva->descricao;
        $this->abertura = $preventiva->abertura->format('Y-m-d');
        $this->colaboradorId = $preventiva->colaborador_id;
        $this->agencia = $preventiva->agencia;
        $this->endereco = $preventiva->endereco;
        $this->comentarios = $preventiva->comentarios;
    }

    /**
     * @return array<string, mixed>
     */
    public function toData(): array
    {
        return [
            'status' => $this->status,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'abertura' => $this->abertura,
            'colaborador_id' => $this->colaboradorId,
            'agencia' => $this->agencia,
            'endereco_id' => Preventiva::resolverEnderecoId($this->agencia),
            'endereco' => $this->endereco,
            'comentarios' => $this->comentarios,
        ];
    }
}
