<div
    class="border border-blue-200 rounded-md bg-blue-50"
    x-data="{
        medicaoOpen: false,
        @if ($dropzoneHabilitado)
        dropzoneEnabled: true,
        isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || (navigator.maxTouchPoints > 1 && window.screen.width <= 1024),
        activeDropAntesId: null,
        clickDepois(antesId) {
            $wire.uploadingAntesId = antesId;
            $nextTick(() => $refs.fotoInputMedicao.click());
        },
        async selectDepois(event) {
            const antesId = $wire.uploadingAntesId;
            if (! antesId) {
                return;
            }
            const files = Array.from(event.target.files ?? []).filter(file => file.type.startsWith('image/'));
            event.target.value = '';
            for (const file of files) {
                $wire.uploadingAntesId = antesId;
                await $wire.upload('fotoUpload', file);
            }
        },
        async dropDepois(event, antesId) {
            const files = Array.from(event.dataTransfer?.files ?? []).filter(file => file.type.startsWith('image/'));
            if (files.length === 0) {
                return;
            }
            this.activeDropAntesId = null;
            for (const file of files) {
                $wire.uploadingAntesId = antesId;
                await $wire.upload('fotoUpload', file);
            }
        },
        dragOverDepois(antesId) {
            this.activeDropAntesId = antesId;
        },
        dragLeaveDepois(event) {
            if (! event.currentTarget.contains(event.relatedTarget)) {
                this.activeDropAntesId = null;
            }
        },
        @endif
    }"
>
    <button
        type="button"
        @click="medicaoOpen = !medicaoOpen"
        class="w-full px-4 py-3 flex justify-between items-center cursor-pointer"
    >
        <span class="text-sm font-medium text-default-700 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
            Relatório de Medição ({{ $this->totalMedicaoImagens }})
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-default-500 transition-transform duration-200" :class="medicaoOpen && 'rotate-180'"><polyline points="6 9 12 15 18 9"/></svg>
    </button>
    <div x-show="medicaoOpen" x-collapse>
        <div class="px-4 pb-4 space-y-3">
            @if ($this->preventiva->imagensAceitasComMedicao->isEmpty())
                <p class="text-sm text-default-500 text-center py-4">
                    Adicione fotos aceitas na galeria acima para habilitar o relatório de medição.
                </p>
            @else
                <div class="grid grid-cols-2 gap-2 text-center">
                    <span class="text-xs font-semibold text-default-500 uppercase">Antes</span>
                    <span class="text-xs font-semibold text-default-500 uppercase">Depois</span>
                </div>

                @foreach ($this->preventiva->imagensAceitasComMedicao as $imagemAntes)
                    <div wire:key="medicao-par-{{ $imagemAntes->id }}" class="grid grid-cols-2 gap-3">
                        <div>
                            <div class="relative aspect-square">
                                <img
                                    src="{{ asset('storage/' . $imagemAntes->path) }}"
                                    alt="Antes"
                                    class="w-full h-full object-cover rounded border border-default-200"
                                >
                            </div>
                            @if ($imagemAntes->legenda)
                                <p class="mt-1 text-xs text-default-600 line-clamp-2">{{ $imagemAntes->legenda }}</p>
                            @endif
                        </div>

                        <div class="grid grid-cols-3 gap-2">
                            @if ($dropzoneHabilitado)
                                <div
                                    role="button"
                                    tabindex="0"
                                    @click="clickDepois({{ $imagemAntes->id }})"
                                    @keydown.enter.prevent="clickDepois({{ $imagemAntes->id }})"
                                    @keydown.space.prevent="clickDepois({{ $imagemAntes->id }})"
                                    @drop.prevent="dropzoneEnabled && !isMobile && dropDepois($event, {{ $imagemAntes->id }})"
                                    @dragover.prevent="dropzoneEnabled && !isMobile && dragOverDepois({{ $imagemAntes->id }})"
                                    @dragleave.prevent="dragLeaveDepois($event)"
                                    :class="{ 'border-primary bg-primary/5': activeDropAntesId === {{ $imagemAntes->id }} }"
                                    class="col-span-3 aspect-[3/1] border-2 border-dashed border-default-300 rounded flex items-center justify-center gap-2 cursor-pointer hover:border-primary hover:bg-primary/5 transition-colors"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300 shrink-0"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                    <span class="text-[10px] text-default-400 uppercase font-medium">Depois</span>
                                    <span x-show="dropzoneEnabled && !isMobile" class="text-[10px] text-default-400 normal-case">— arraste ou clique</span>
                                </div>
                            @else
                                <div
                                    @click="clickDepois({{ $imagemAntes->id }})"
                                    class="col-span-3 aspect-[3/1] border-2 border-dashed border-default-300 rounded flex items-center justify-center gap-2 cursor-pointer hover:border-primary hover:bg-primary/5 transition-colors"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300 shrink-0"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                    <span class="text-[10px] text-default-400 uppercase font-medium">Depois</span>
                                </div>
                            @endif

                            @foreach ($imagemAntes->medicaoImagens as $medicaoImagem)
                                <div wire:key="medicao-foto-{{ $medicaoImagem->id }}" class="relative group aspect-square">
                                    <img
                                        src="{{ asset('storage/' . $medicaoImagem->path) }}"
                                        alt="Depois"
                                        class="w-full h-full object-cover rounded border border-default-200"
                                    >
                                    <button
                                        type="button"
                                        wire:click="removerMedicaoImagem({{ $medicaoImagem->id }})"
                                        class="absolute top-1 right-1 size-5 bg-danger text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <input
                    x-ref="fotoInputMedicao"
                    type="file"
                    accept="image/*"
                    multiple
                    class="hidden"
                    @change="selectDepois($event)"
                >

                <div wire:loading wire:target="fotoUpload" class="text-sm text-primary text-center py-2">
                    Carregando imagem...
                </div>
            @endif
        </div>
    </div>
</div>
