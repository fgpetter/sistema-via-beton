<div class="border border-blue-200 rounded-md bg-blue-50" x-data="{ fotosOpen: false }">
    <button
        type="button"
        @click="fotosOpen = !fotosOpen"
        class="w-full px-4 py-3 flex justify-between items-center cursor-pointer"
    >
        <span class="text-sm font-medium text-default-700 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
            Fotos ({{ $this->preventiva->imagens->count() }})
            @if ($this->preventiva->imagens->where('recusada', true)->count() > 0)
                <span class="text-xs text-danger">({{ $this->preventiva->imagens->where('recusada', true)->count() }} recusada(s))</span>
            @endif
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-default-500 transition-transform duration-200" :class="fotosOpen && 'rotate-180'"><polyline points="6 9 12 15 18 9"/></svg>
    </button>
    <div x-show="fotosOpen" x-collapse>
        <div class="px-4 pb-4 space-y-3">
            <!-- Upload -->
            <div
                @click="$nextTick(() => $refs.fotoInputGaleria.click())"
                class="aspect-video border-2 border-dashed border-default-300 rounded flex flex-col items-center justify-center cursor-pointer hover:border-primary hover:bg-primary/5 transition-colors"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                <span class="text-sm text-default-400 mt-1">Clique para adicionar foto</span>
            </div>

            <input x-ref="fotoInputGaleria" wire:model="fotoUpload" type="file" accept="image/*" class="hidden">

            <div wire:loading wire:target="fotoUpload" class="text-sm text-primary text-center py-2">
                Carregando imagem...
            </div>

            <!-- Galeria -->
            @if ($this->preventiva->imagens->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach ($this->preventiva->imagens as $imagem)
                        <div wire:key="preventiva-foto-{{ $imagem->id }}" class="relative group">
                            <div class="relative aspect-square {{ $imagem->recusada ? 'opacity-50' : '' }}">
                                <img src="{{ asset('storage/' . $imagem->path) }}" alt="Foto" class="w-full h-full object-cover rounded border border-default-200">
                                @if ($imagem->recusada)
                                    <span class="absolute top-1 left-1 py-0.5 px-1.5 text-[10px] font-semibold uppercase bg-danger text-white rounded">Recusado</span>
                                @endif
                                <button
                                    type="button"
                                    wire:click="removerImagem({{ $imagem->id }})"
                                    class="absolute top-1 right-1 size-5 bg-danger text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                </button>
                            </div>
                            <input
                                type="text"
                                value="{{ $imagem->legenda ?? '' }}"
                                @blur="$wire.salvarLegenda({{ $imagem->id }}, $event.target.value)"
                                placeholder="Legenda..."
                                class="w-full mt-1 text-xs border border-default-200 rounded px-2 py-1 focus:outline-none focus:border-primary"
                            >
                            <label class="inline-flex items-center gap-1.5 mt-1 cursor-pointer">
                                <input
                                    type="checkbox"
                                    wire:click="toggleRecusada({{ $imagem->id }})"
                                    {{ $imagem->recusada ? 'checked' : '' }}
                                    class="rounded border-default-300 text-danger focus:ring-danger/30 size-3"
                                >
                                <span class="text-xs {{ $imagem->recusada ? 'text-danger font-medium' : 'text-default-500' }}">Recusada</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
