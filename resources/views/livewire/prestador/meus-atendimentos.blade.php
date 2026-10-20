<div>
    @include('layouts.partials/page-title', ['title' => 'Meus Atendimentos'])

    <div class="flex justify-end mb-4">
        <button
            type="button"
            wire:click="alternarVisaoAtendimentos"
            class="btn btn-sm bg-primary/10 text-primary hover:bg-primary hover:text-white"
        >
            @if ($mostrarConcluidos)
                Ver em aberto
            @else
                Ver concluídos
            @endif
        </button>
    </div>

    <div class="space-y-4">
        @forelse ($this->ocorrencias as $ocorrencia)
            <a
                wire:key="ocorrencia-{{ $ocorrencia->id }}"
                href="{{ route('prestador.atendimento', $ocorrencia->id) }}"
                class="block card hover:shadow-lg transition-shadow duration-200 {{ $ocorrencia->isEmergencial() ? 'border-l-4 border-l-danger bg-danger/5' : '' }}"
            >
                <div class="card-body">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            @if ($ocorrencia->isEmergencial())
                                <span class="py-0.5 px-2 inline-flex items-center text-xs font-bold bg-danger/15 text-danger rounded mb-1">
                                    {{ $ocorrencia->prazo->nome }}
                                </span>
                            @endif
                            <h6 class="font-semibold text-default-800 text-base mb-1">{{ $ocorrencia->agencia }} - {{ $ocorrencia->id }}</h6>
                            <p class="text-default-700 font-medium text-sm mb-2">{{ $ocorrencia->titulo }}</p>
                            @if ($ocorrencia->descricao)
                                <p class="text-default-500 text-sm line-clamp-2">{{ $ocorrencia->descricao }}</p>
                            @endif
                        </div>
                        <div class="flex flex-col items-end gap-2 shrink-0">
                            <span class="py-0.5 px-2.5 inline-flex items-center text-xs font-medium bg-{{ $ocorrencia->status->color() }}/10 text-{{ $ocorrencia->status->color() }} rounded">
                                {{ $ocorrencia->status->label() }}
                            </span>
                            <span class="text-xs text-default-400">{{ $ocorrencia->abertura->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </a>
        @empty
                            @if ($this->programadas->isEmpty())
            <div class="card">
                <div class="card-body">
                    <div class="flex flex-col items-center gap-3 py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        <p class="text-default-500">
                            @if ($mostrarConcluidos)
                                Nenhum atendimento concluído.
                            @else
                                Nenhum atendimento em aberto.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    @if ($this->programadas->isNotEmpty())
        <h2 class="text-lg font-semibold text-default-800 mt-8 mb-3">Programadas</h2>
        <div class="space-y-4">
            @foreach ($this->programadas as $programada)
                <a wire:key="programada-{{ $programada->id }}" href="{{ route('prestador.programada-atendimento', $programada->id) }}" class="block card hover:shadow-lg transition-shadow duration-200">
                    <div class="card-body">
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <span class="text-xs text-primary font-medium">{{ $programada->tipo->label() }}</span>
                                <h6 class="font-semibold text-default-800 text-base mb-1">{{ $programada->agencia }} - {{ $programada->id }}</h6>
                                <p class="text-default-700 font-medium text-sm">{{ $programada->titulo }}</p>
                                @if ($programada->descricao)<p class="text-default-500 text-sm line-clamp-2">{{ $programada->descricao }}</p>@endif
                            </div>
                            @endif
                            <div class="flex flex-col items-end gap-2 shrink-0">
                                <span class="py-0.5 px-2.5 inline-flex items-center text-xs font-medium bg-{{ $programada->status->color() }}/10 text-{{ $programada->status->color() }} rounded">{{ $programada->status->label() }}</span>
                                <span class="text-xs text-default-400">{{ $programada->abertura->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
