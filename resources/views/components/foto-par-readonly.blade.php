@props(['fotos', 'wireKey'])

<div wire:key="{{ $wireKey }}" class="grid grid-cols-2 gap-3">
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
