<div>
    @include('layouts.partials/page-title', ['title' => 'Meus Atendimentos'])

    <div class="space-y-4">
        @forelse ($this->ocorrencias as $ocorrencia)
            <a
                wire:key="ocorrencia-{{ $ocorrencia->id }}"
                href="{{ route('prestador.atendimento', $ocorrencia->id) }}"
                class="block card hover:shadow-lg transition-shadow duration-200"
            >
                <div class="card-body">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <h6 class="font-semibold text-default-800 text-base mb-1">{{ $ocorrencia->agencia }}</h6>
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
            <div class="card">
                <div class="card-body">
                    <div class="flex flex-col items-center gap-3 py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        <p class="text-default-500">Nenhum atendimento designado a você.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
