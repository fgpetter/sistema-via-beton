@props(['label', 'imagens'])

@if ($imagens->count())
    <div class="card">
        <div class="card-header">
            <h6 class="card-title text-sm uppercase text-default-600">{{ $label }}</h6>
            <span class="py-0.5 px-2 text-xs font-semibold bg-danger/10 text-danger rounded">{{ $imagens->count() }}</span>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-3 gap-2">
                @foreach ($imagens as $imagem)
                    <img wire:key="img-gallery-{{ $imagem->id }}" src="{{ asset('storage/' . $imagem->path) }}" alt="{{ $label }}" class="w-full aspect-square object-cover rounded border border-default-200">
                @endforeach
            </div>
        </div>
    </div>
@endif
