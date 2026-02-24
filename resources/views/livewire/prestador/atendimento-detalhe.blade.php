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
            <div class="text-sm text-default-500">
                <span>Abertura: <strong>{{ $this->ocorrencia->abertura->format('d/m/Y') }}</strong></span>
            </div>
        </div>
    </div>

    @if ($this->ocorrencia->status !== \App\Enums\OcorrenciaStatus::Concluido)

    <!-- Fotos Antes e Depois -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        @include('livewire.prestador.partials.image-upload-card', [
            'label' => 'Antes',
            'imagens' => $this->ocorrencia->imagensAntes,
            'fotos' => $fotosAntes,
            'inputRef' => 'inputAntes',
            'wireModel' => 'fotosAntes',
            'uploadAction' => 'uploadFotosAntes',
        ])
        @include('livewire.prestador.partials.image-upload-card', [
            'label' => 'Depois',
            'imagens' => $this->ocorrencia->imagensDepois,
            'fotos' => $fotosDepois,
            'inputRef' => 'inputDepois',
            'wireModel' => 'fotosDepois',
            'uploadAction' => 'uploadFotosDepois',
        ])
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

    @else

    <!-- Ocorrência já concluída -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="flex flex-col items-center gap-3 py-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-success"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <p class="text-default-600 font-medium">Esta ocorrência foi concluída.</p>
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

    @endif
</div>
