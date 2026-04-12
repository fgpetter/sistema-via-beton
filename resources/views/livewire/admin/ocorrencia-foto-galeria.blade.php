<div class="border border-blue-200 rounded-md bg-blue-50" x-data="{ fotosOpen: false }">
    <button
        type="button"
        @click="fotosOpen = !fotosOpen"
        class="w-full px-4 py-3 flex justify-between items-center cursor-pointer"
    >
        <span class="text-sm font-medium text-default-700 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
            Fotos
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-default-500 transition-transform duration-200" :class="fotosOpen && 'rotate-180'"><polyline points="6 9 12 15 18 9"/></svg>
    </button>
    <div x-show="fotosOpen" x-collapse>
        <div class="px-4 pb-4 space-y-3">
            <div class="grid grid-cols-2 gap-2 text-center">
                <span class="text-xs font-semibold text-default-500 uppercase">Antes</span>
                <span class="text-xs font-semibold text-default-500 uppercase">Depois</span>
            </div>

            @foreach ($this->fotoPares as $par => $fotos)
                <div wire:key="admin-foto-par-{{ $par }}" class="grid grid-cols-2 gap-3">
                    @if ($fotos['antes'])
                        <div class="relative group aspect-square">
                            <img src="{{ asset('storage/' . $fotos['antes']->path) }}" alt="Antes" class="w-full h-full object-cover rounded border border-default-200">
                            <span class="absolute bottom-1 left-1 py-0.5 px-1.5 text-[10px] font-semibold uppercase bg-black/60 text-white rounded">Antes</span>
                            <button
                                type="button"
                                wire:click="removerImagem({{ $fotos['antes']->id }})"
                                class="absolute top-1 right-1 size-5 bg-danger text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </button>
                        </div>
                    @else
                        <div
                            @click="$wire.uploadingPar = {{ $par }}; $wire.uploadingTipo = 'antes'; $nextTick(() => $refs.fotoInputGaleria.click())"
                            class="aspect-square border-2 border-dashed border-default-300 rounded flex flex-col items-center justify-center cursor-pointer hover:border-primary hover:bg-primary/5 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            <span class="text-[10px] text-default-400 mt-1 uppercase font-medium">Antes</span>
                        </div>
                    @endif

                    @if ($fotos['depois'])
                        <div class="relative group aspect-square">
                            <img src="{{ asset('storage/' . $fotos['depois']->path) }}" alt="Depois" class="w-full h-full object-cover rounded border border-default-200">
                            <span class="absolute bottom-1 left-1 py-0.5 px-1.5 text-[10px] font-semibold uppercase bg-black/60 text-white rounded">Depois</span>
                            <button
                                type="button"
                                wire:click="removerImagem({{ $fotos['depois']->id }})"
                                class="absolute top-1 right-1 size-5 bg-danger text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </button>
                        </div>
                    @else
                        <div class="aspect-square border-2 border-dashed border-default-200 rounded flex flex-col items-center justify-center bg-default-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-200"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            <span class="text-[10px] text-default-300 mt-1 uppercase font-medium">Depois</span>
                        </div>
                    @endif
                </div>
            @endforeach

            <div wire:loading wire:target="fotoUpload" class="text-sm text-primary text-center py-2">
                Carregando imagem...
            </div>

            <button
                type="button"
                wire:click="adicionarPar"
                class="btn w-full border-2 border-dashed border-default-300 text-default-500 hover:border-primary hover:text-primary hover:bg-primary/5 transition-colors text-sm"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Adicionar Foto
            </button>

            <input x-ref="fotoInputGaleria" wire:model="fotoUpload" type="file" accept="image/*" class="hidden">
        </div>
    </div>
</div>
