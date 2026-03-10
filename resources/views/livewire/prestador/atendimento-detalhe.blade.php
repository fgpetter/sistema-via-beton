<div>
    @include('layouts.partials/page-title', ['subtitle' => 'Atendimentos', 'title' => 'Detalhes do Atendimento'])

    <div class="mb-4">
        <a href="{{ route('prestador.atendimentos') }}" class="inline-flex items-center gap-1 text-sm text-primary hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            Voltar aos atendimentos
        </a>
    </div>

    <!-- Detalhes da Ocorrência -->
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="card-title">{{ $this->ocorrencia->agencia }}</h6>
            <span class="py-0.5 px-2.5 inline-flex items-center text-xs font-medium bg-{{ $this->ocorrencia->status->color() }}/10 text-{{ $this->ocorrencia->status->color() }} rounded">
                {{ $this->ocorrencia->status->label() }}
            </span>
        </div>
        <div class="card-body space-y-3">
            <div>
                <span class="text-xs font-medium text-default-500 uppercase">Título</span>
                <p class="text-default-800">{{ $this->ocorrencia->titulo }}</p>
            </div>
            @if ($this->ocorrencia->descricao)
                <div>
                    <span class="text-xs font-medium text-default-500 uppercase">Descrição</span>
                    <p class="text-default-800">{{ $this->ocorrencia->descricao }}</p>
                </div>
            @endif
            @if ($this->ocorrencia->comentarios)
                <div>
                    <span class="text-xs font-medium text-default-500 uppercase">Comentários da Abertura</span>
                    <p class="text-default-700 bg-default-50 p-3 rounded text-sm">{{ $this->ocorrencia->comentarios }}</p>
                </div>
            @endif
            @if ($this->ocorrencia->endereco)
                <div>
                    <span class="text-xs font-medium text-default-500 uppercase">Endereço</span>
                    <p class="text-default-800">{{ $this->ocorrencia->endereco }}</p>
                </div>
            @endif
            <div class="flex flex-wrap gap-4 text-sm text-default-500">
                <span>Abertura: <strong>{{ $this->ocorrencia->abertura->format('d/m/Y') }}</strong></span>
                @if ($this->ocorrencia->datahora_chegada)
                    <span>Chegada: <strong>{{ $this->ocorrencia->datahora_chegada->format('d/m/Y H:i') }}</strong></span>
                @endif
                @if ($this->ocorrencia->datahora_saida)
                    <span>Saída: <strong>{{ $this->ocorrencia->datahora_saida->format('d/m/Y H:i') }}</strong></span>
                @endif
            </div>
        </div>
    </div>

    @if (in_array($this->ocorrencia->status, [\App\Enums\OcorrenciaStatus::Aberto, \App\Enums\OcorrenciaStatus::Andamento]) && ! $this->ocorrencia->atendimentoIniciado())

    <!-- Botão Iniciar Atendimento -->
    <div class="card">
        <div class="card-body">
            <div class="flex flex-col items-center gap-4 py-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                    <circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/>
                </svg>
                <p class="text-default-600 text-center max-w-sm">
                    Clique no botão abaixo para registrar sua chegada e iniciar o atendimento.
                </p>
                <button
                    type="button"
                    wire:click="iniciarAtendimento"
                    wire:confirm="Confirma o início do atendimento? A data e hora de chegada serão registradas."
                    class="btn bg-primary text-white uppercase font-semibold text-lg px-8 py-3"
                    wire:loading.attr="disabled"
                    wire:target="iniciarAtendimento"
                >
                    <span wire:loading.remove wire:target="iniciarAtendimento">Iniciar Atendimento</span>
                    <span wire:loading wire:target="iniciarAtendimento">Iniciando...</span>
                </button>
            </div>
        </div>
    </div>

    @elseif ($this->ocorrencia->status === \App\Enums\OcorrenciaStatus::Andamento && $this->ocorrencia->atendimentoIniciado())

    <!-- Fotos (Collapse) -->
    <div class="card mb-4" x-data>
        <button
            type="button"
            class="hs-collapse-toggle card-header w-full flex justify-between items-center cursor-pointer"
            id="hs-fotos-prestador-toggle"
            aria-controls="hs-fotos-prestador-content"
            aria-expanded="true"
            data-hs-collapse="#hs-fotos-prestador-content"
        >
            <h6 class="card-title text-sm uppercase text-default-600 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                Fotos
            </h6>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hs-collapse-open:hidden"><polyline points="6 9 12 15 18 9"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hs-collapse-open:block hidden"><polyline points="18 15 12 9 6 15"/></svg>
        </button>
        <div
            id="hs-fotos-prestador-content"
            class="hs-collapse w-full overflow-hidden transition-[height] duration-300"
            aria-labelledby="hs-fotos-prestador-toggle"
        >
            <div class="card-body pt-0">
                <div class="space-y-3">
                    @foreach ($this->fotoPares as $par => $fotos)
                        <div wire:key="par-{{ $par }}" class="grid grid-cols-2 gap-3">
                            <!-- ANTES -->
                            @if ($fotos['antes'])
                                <div class="relative group aspect-square">
                                    <img src="{{ asset('storage/' . $fotos['antes']->path) }}" alt="Antes" class="w-full h-full object-cover rounded border border-default-200">
                                    <span class="absolute bottom-1 left-1 py-0.5 px-1.5 text-[10px] font-semibold uppercase bg-black/60 text-white rounded">Antes</span>
                                    <button
                                        type="button"
                                        wire:click="removerImagem({{ $fotos['antes']->id }})"
                                        wire:confirm="Remover esta imagem?"
                                        class="absolute top-1 right-1 size-5 bg-danger text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    </button>
                                </div>
                            @else
                                <div
                                    @click="$wire.uploadingPar = {{ $par }}; $wire.uploadingTipo = 'antes'; $nextTick(() => $refs.fotoInput.click())"
                                    class="aspect-square border-2 border-dashed border-default-300 rounded flex flex-col items-center justify-center cursor-pointer hover:border-primary hover:bg-primary/5 transition-colors"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                    <span class="text-xs text-default-400 mt-1 uppercase font-medium">Antes</span>
                                </div>
                            @endif

                            <!-- DEPOIS -->
                            @if ($fotos['depois'])
                                <div class="relative group aspect-square">
                                    <img src="{{ asset('storage/' . $fotos['depois']->path) }}" alt="Depois" class="w-full h-full object-cover rounded border border-default-200">
                                    <span class="absolute bottom-1 left-1 py-0.5 px-1.5 text-[10px] font-semibold uppercase bg-black/60 text-white rounded">Depois</span>
                                    <button
                                        type="button"
                                        wire:click="removerImagem({{ $fotos['depois']->id }})"
                                        wire:confirm="Remover esta imagem?"
                                        class="absolute top-1 right-1 size-5 bg-danger text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    </button>
                                </div>
                            @else
                                <div
                                    @click="$wire.uploadingPar = {{ $par }}; $wire.uploadingTipo = 'depois'; $nextTick(() => $refs.fotoInput.click())"
                                    class="aspect-square border-2 border-dashed border-default-300 rounded flex flex-col items-center justify-center cursor-pointer hover:border-primary hover:bg-primary/5 transition-colors"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                    <span class="text-xs text-default-400 mt-1 uppercase font-medium">Depois</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div wire:loading wire:target="fotoUpload" class="text-sm text-primary text-center py-2">
                    Carregando imagem...
                </div>

                <button
                    type="button"
                    wire:click="adicionarPar"
                    class="btn w-full mt-3 border-2 border-dashed border-default-300 text-default-500 hover:border-primary hover:text-primary hover:bg-primary/5 transition-colors"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Adicionar Foto
                </button>

                <input x-ref="fotoInput" wire:model="fotoUpload" type="file" accept="image/*" class="hidden">
            </div>
        </div>
    </div>

    <!-- Comentários do Prestador -->
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="card-title text-sm">Comentários do Atendimento</h6>
        </div>
        <div class="card-body">
            <form wire:submit="salvarComentarios">
                <textarea
                    wire:model="comentariosPrestador"
                    rows="3"
                    class="form-input w-full mb-2"
                    placeholder="Observações sobre o atendimento realizado..."
                ></textarea>
                @error('comentariosPrestador') <p class="text-sm text-danger mb-2">{{ $message }}</p> @enderror
                <button type="submit" class="btn btn-sm bg-default-200 text-default-700 hover:bg-default-300" wire:loading.attr="disabled" wire:target="salvarComentarios">
                    <span wire:loading.remove wire:target="salvarComentarios">Salvar Comentários</span>
                    <span wire:loading wire:target="salvarComentarios">Salvando...</span>
                </button>
            </form>
        </div>
    </div>

    <!-- E-mail RAT -->
    <div class="flex items-end gap-2 mb-4">
        <div class="flex-1">
            <input
                wire:model="emailRat"
                type="email"
                id="emailRat"
                class="form-input w-full @error('emailRat') border-danger @enderror"
                placeholder="EMAIL@AGENCIA.COM"
            >
            @error('emailRat') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
        </div>
        <button
            type="button"
            wire:click="enviarEmail"
            class="btn bg-primary text-white shrink-0 uppercase font-semibold"
            wire:loading.attr="disabled"
            wire:target="enviarEmail"
        >
            <span wire:loading.remove wire:target="enviarEmail">Enviar</span>
            <span wire:loading wire:target="enviarEmail">Enviando...</span>
        </button>
    </div>

    <!-- Concluir -->
    <button
        type="button"
        wire:click="concluir"
        wire:confirm="Confirma a conclusão do atendimento? A data e hora de saída serão registradas."
        class="btn bg-success text-white uppercase font-semibold"
        wire:loading.attr="disabled"
        wire:target="concluir"
        @if (! $this->ocorrencia->podeConcluir()) disabled @endif
    >
        <span wire:loading.remove wire:target="concluir">Concluir</span>
        <span wire:loading wire:target="concluir">Concluindo...</span>
    </button>

    @if (! $this->ocorrencia->podeConcluir())
        <p class="text-xs text-default-400 mt-2">
            Para concluir: ao menos 1 foto antes, 1 foto depois e e-mail enviado.
        </p>
    @endif

    @elseif ($this->ocorrencia->status === \App\Enums\OcorrenciaStatus::Revisar)

    <!-- Ocorrência em revisão -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="flex flex-col items-center gap-3 py-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                <p class="text-default-600 font-medium">Atendimento concluído. Aguardando revisão do administrador.</p>
            </div>
        </div>
    </div>

    @if ($this->ocorrencia->imagensAntes->count() || $this->ocorrencia->imagensDepois->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            @include('livewire.prestador.partials.image-gallery-card', ['label' => 'Antes', 'imagens' => $this->ocorrencia->imagensAntes])
            @include('livewire.prestador.partials.image-gallery-card', ['label' => 'Depois', 'imagens' => $this->ocorrencia->imagensDepois])
        </div>
    @endif

    @if ($this->ocorrencia->comentarios_prestador)
        <div class="card mb-4">
            <div class="card-header"><h6 class="card-title text-sm">Comentários do Atendimento</h6></div>
            <div class="card-body"><p class="text-default-700">{{ $this->ocorrencia->comentarios_prestador }}</p></div>
        </div>
    @endif

    @elseif ($this->ocorrencia->status === \App\Enums\OcorrenciaStatus::Concluido)

    <!-- Ocorrência concluída -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="flex flex-col items-center gap-3 py-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-success"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <p class="text-default-600 font-medium">Esta ocorrência foi concluída.</p>
                @if ($this->ocorrencia->concluidoPor)
                    <p class="text-sm text-default-400">Revisado por: <strong>{{ $this->ocorrencia->concluidoPor->name }}</strong></p>
                @endif
            </div>
        </div>
    </div>

    @if ($this->ocorrencia->imagens->count())
        <!-- Fotos (Collapse) - Somente Leitura -->
        <div class="card mb-4">
            <button
                type="button"
                class="hs-collapse-toggle card-header w-full flex justify-between items-center cursor-pointer"
                id="hs-fotos-concluida-toggle"
                aria-controls="hs-fotos-concluida-content"
                aria-expanded="true"
                data-hs-collapse="#hs-fotos-concluida-content"
            >
                <h6 class="card-title text-sm uppercase text-default-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                    Fotos
                </h6>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hs-collapse-open:hidden"><polyline points="6 9 12 15 18 9"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hs-collapse-open:block hidden"><polyline points="18 15 12 9 6 15"/></svg>
            </button>
            <div
                id="hs-fotos-concluida-content"
                class="hs-collapse w-full overflow-hidden transition-[height] duration-300"
                aria-labelledby="hs-fotos-concluida-toggle"
            >
                <div class="card-body pt-0 space-y-3">
                    @foreach ($this->ocorrencia->fotoPares() as $par => $fotos)
                        <div wire:key="par-gallery-{{ $par }}" class="grid grid-cols-2 gap-3">
                            @if ($fotos['antes'])
                                <div class="relative aspect-square">
                                    <img src="{{ asset('storage/' . $fotos['antes']->path) }}" alt="Antes" class="w-full h-full object-cover rounded border border-default-200">
                                    <span class="absolute bottom-1 left-1 py-0.5 px-1.5 text-[10px] font-semibold uppercase bg-black/60 text-white rounded">Antes</span>
                                </div>
                            @else
                                <div class="aspect-square bg-default-100 rounded flex items-center justify-center">
                                    <span class="text-xs text-default-400 uppercase">Antes</span>
                                </div>
                            @endif
                            @if ($fotos['depois'])
                                <div class="relative aspect-square">
                                    <img src="{{ asset('storage/' . $fotos['depois']->path) }}" alt="Depois" class="w-full h-full object-cover rounded border border-default-200">
                                    <span class="absolute bottom-1 left-1 py-0.5 px-1.5 text-[10px] font-semibold uppercase bg-black/60 text-white rounded">Depois</span>
                                </div>
                            @else
                                <div class="aspect-square bg-default-100 rounded flex items-center justify-center">
                                    <span class="text-xs text-default-400 uppercase">Depois</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if ($this->ocorrencia->comentarios_prestador)
        <div class="card mb-4">
            <div class="card-header"><h6 class="card-title text-sm">Comentários do Atendimento</h6></div>
            <div class="card-body"><p class="text-default-700">{{ $this->ocorrencia->comentarios_prestador }}</p></div>
        </div>
    @endif

    @endif
</div>
