<?php

namespace App\Livewire\Prestador;

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
    #[Computed]
    public function ocorrencias()
    {
        /** @var User $user */
        $user = auth()->user();
        $colaborador = $user->colaborador;

        if (! $colaborador) {
            return collect();
        }

        return Ocorrencia::query()
            ->with('prazo')
            ->where('colaborador_id', $colaborador->id)
            ->ordemListaPrestador()
            ->get();
    }

    public function render(): View
    {
        return view('livewire.prestador.meus-atendimentos');
    }
}
