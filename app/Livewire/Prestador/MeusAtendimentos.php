<?php

namespace App\Livewire\Prestador;

use App\Enums\OcorrenciaStatus;
use App\Models\Ocorrencia;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.vertical')]
#[Title('Meus Atendimentos')]
class MeusAtendimentos extends Component
{
    public bool $mostrarConcluidos = false;

    public function alternarVisaoAtendimentos(): void
    {
        $this->mostrarConcluidos = ! $this->mostrarConcluidos;
    }

    #[Computed]
    public function ocorrencias()
    {
        /** @var User $user */
        $user = auth()->user();
        $colaborador = $user->colaborador;

        if (! $colaborador) {
            return collect();
        }

        $query = Ocorrencia::query()
            ->with('prazo')
            ->where('colaborador_id', $colaborador->id);

        if ($this->mostrarConcluidos) {
            $query->where('status', OcorrenciaStatus::Concluido);
        } else {
            $query->where('status', '!=', OcorrenciaStatus::Concluido);
        }

        return $query->ordemListaPrestador()->get();
    }

    public function render(): View
    {
        return view('livewire.prestador.meus-atendimentos');
    }
}
