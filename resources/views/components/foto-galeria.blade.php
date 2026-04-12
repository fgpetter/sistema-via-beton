@props([
    'collapseId',
    'fotoPares',
    'wireKeyPrefix',
    'cardClass' => 'card mb-4',
    'collapsePanelClass' => 'hs-collapse w-full overflow-hidden transition-[height] duration-300',
])

<div {{ $attributes->class([$cardClass]) }}>
    <button
        type="button"
        class="hs-collapse-toggle card-header w-full flex justify-between items-center cursor-pointer"
        id="hs-fotos-{{ $collapseId }}-toggle"
        aria-controls="hs-fotos-{{ $collapseId }}-content"
        aria-expanded="true"
        data-hs-collapse="#hs-fotos-{{ $collapseId }}-content"
    >
        <h6 class="card-title text-sm uppercase text-default-600 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
            Fotos
        </h6>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hs-collapse-open:hidden"><polyline points="6 9 12 15 18 9"/></svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hs-collapse-open:block hidden"><polyline points="18 15 12 9 6 15"/></svg>
    </button>
    <div
        id="hs-fotos-{{ $collapseId }}-content"
        class="{{ $collapsePanelClass }}"
        aria-labelledby="hs-fotos-{{ $collapseId }}-toggle"
    >
        <div class="card-body pt-0 space-y-3">
            @foreach ($fotoPares as $par => $fotos)
                <x-foto-par-readonly :fotos="$fotos" :wireKey="$wireKeyPrefix.'-'.$par" />
            @endforeach
        </div>
    </div>
</div>
