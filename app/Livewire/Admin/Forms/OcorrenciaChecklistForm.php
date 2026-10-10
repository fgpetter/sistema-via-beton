<?php

namespace App\Livewire\Admin\Forms;

use App\Contracts\ChecklistBlocoContract;
use App\Enums\ChecklistResposta;
use App\Enums\TipoChecklist;
use App\Models\Ocorrencia;
use Illuminate\Validation\Rule;
use Livewire\Form;

class OcorrenciaChecklistForm extends Form
{
    public TipoChecklist $tipo = TipoChecklist::Civil;

    public ?int $ocorrenciaId = null;

    /**
     * Respostas indexadas por bloco e depois por formKey do item (ex.: respostas[copa][5_1]).
     *
     * @var array<string, array<string, string>>
     */
    public array $respostas = [];

    public ?string $observacoes = null;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        $rules = [
            'observacoes' => ['nullable', 'string', 'max:5000'],
        ];

        foreach ($this->tipo->blocos() as $bloco) {
            $formKeys = $bloco->formKeys();

            $rules["respostas.{$bloco->value}"] = [
                'required',
                'array',
                'size:'.count($formKeys),
                'required_array_keys:'.implode(',', $formKeys),
            ];
            $rules["respostas.{$bloco->value}.*"] = ['required', Rule::enum(ChecklistResposta::class)];
        }

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        $messages = [
            'observacoes.max' => 'As observações não podem ter mais de 5000 caracteres.',
        ];

        foreach ($this->tipo->blocos() as $bloco) {
            $blocoMensagem = "Preencha todos os itens do bloco {$bloco->codigo()} {$bloco->label()}.";

            $messages["respostas.{$bloco->value}.required"] = $blocoMensagem;
            $messages["respostas.{$bloco->value}.array"] = $blocoMensagem;
            $messages["respostas.{$bloco->value}.size"] = $blocoMensagem;
            $messages["respostas.{$bloco->value}.required_array_keys"] = $blocoMensagem;

            foreach ($bloco->itens() as $item) {
                $chave = "respostas.{$bloco->value}.{$item->formKey()}";
                $mensagem = "Responda o item {$item->codigo()} – {$item->label()}.";

                $messages["{$chave}.required"] = $mensagem;
                $messages["{$chave}.enum"] = $mensagem;
            }
        }

        return $messages;
    }

    public function setFromOcorrencia(Ocorrencia $ocorrencia, TipoChecklist $tipo): void
    {
        $this->tipo = $tipo;
        $checklist = $ocorrencia->{$tipo->relacao()};

        $this->ocorrenciaId = $ocorrencia->id;
        $this->respostas = [];

        foreach ($tipo->blocos() as $bloco) {
            foreach ($bloco->itens() as $item) {
                $resposta = $checklist?->{$bloco->value}[$item->codigo()] ?? null;

                $this->respostas[$bloco->value][$item->formKey()] = $resposta?->value ?? '';
            }
        }

        $this->observacoes = $checklist?->observacoes;
    }

    public function marcarBloco(ChecklistBlocoContract $bloco, ChecklistResposta $resposta): void
    {
        foreach ($bloco->formKeys() as $formKey) {
            $this->respostas[$bloco->value][$formKey] = $resposta->value;
        }
    }

    /**
     * Valor comum a todos os itens do bloco, ou null se estiverem misturados ou vazios.
     */
    public function valorUnificado(ChecklistBlocoContract $bloco): ?string
    {
        $valores = array_values(array_unique($this->respostas[$bloco->value] ?? []));

        return count($valores) === 1 && $valores[0] !== '' ? $valores[0] : null;
    }

    /**
     * @return array<string, mixed>
     */
    public function toData(): array
    {
        $data = [
            'observacoes' => blank($this->observacoes) ? null : $this->observacoes,
        ];

        foreach ($this->tipo->blocos() as $bloco) {
            $data[$bloco->value] = [];

            foreach ($bloco->itens() as $item) {
                $data[$bloco->value][$item->codigo()] = $this->respostas[$bloco->value][$item->formKey()];
            }
        }

        return $data;
    }
}
