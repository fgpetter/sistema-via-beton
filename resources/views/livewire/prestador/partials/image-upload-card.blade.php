@props(['label', 'imagens', 'fotos', 'inputRef', 'wireModel', 'uploadAction'])

<div class="card"
    x-data
    x-on:click="$refs.{{ $inputRef }}.click()"
    class="card cursor-pointer"
>
    <div class="card-header">
        <h6 class="card-title text-sm uppercase text-default-600">{{ $label }}</h6>
        @if ($imagens->count())
            <span class="py-0.5 px-2 text-xs font-semibold bg-danger/10 text-danger rounded">
                {{ $imagens->count() }}
            </span>
        @endif
    </div>
    <div class="card-body">
        @if ($imagens->count())
            <div class="grid grid-cols-3 gap-2 mb-3">
                @foreach ($imagens as $imagem)
                    <div wire:key="img-{{ $inputRef }}-{{ $imagem->id }}" class="relative group aspect-square">
                        <img src="{{ asset('storage/' . $imagem->path) }}" alt="{{ $label }}" class="w-full h-full object-cover rounded border border-default-200">
                        <button
                            type="button"
                            wire:click="removerImagem({{ $imagem->id }})"
                            @click.stop
                            class="absolute top-1 right-1 size-5 bg-danger text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-6 text-default-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <p class="text-sm mt-2">Clique para adicionar fotos</p>
            </div>
        @endif

        <form wire:submit="{{ $uploadAction }}" @click.stop>
            <input
                x-ref="{{ $inputRef }}"
                wire:model="{{ $wireModel }}"
                type="file"
                multiple
                accept="image/*"
                class="hidden"
            >
            @error($wireModel . '.*') <p class="text-sm text-danger mb-2">{{ $message }}</p> @enderror
            <div wire:loading wire:target="{{ $wireModel }}" class="text-sm text-primary text-center py-2">Carregando...</div>
            @if (count($fotos))
                <div class="grid grid-cols-4 gap-2 mb-2">
                    @foreach ($fotos as $foto)
                        <img src="{{ $foto->temporaryUrl() }}" class="w-full aspect-square object-cover rounded border-2 border-primary/30">
                    @endforeach
                </div>
                <button type="submit" class="btn btn-sm bg-primary text-white w-full" wire:loading.attr="disabled" wire:target="{{ $uploadAction }}">
                    <span wire:loading.remove wire:target="{{ $uploadAction }}">Enviar {{ count($fotos) }} foto(s)</span>
                    <span wire:loading wire:target="{{ $uploadAction }}">Enviando...</span>
                </button>
            @endif
        </form>
    </div>
</div>
