@props([
    'wireTarget',
    'buttonText',
    'pendingText',
    'type' => 'button',
    'isDisabled' => false,
])

<button
    type="{{ $type }}"
    {{ $attributes }}
    @disabled($isDisabled)
    wire:loading.attr="disabled"
    wire:target="{{ $wireTarget }}"
>
    <span wire:loading.remove wire:target="{{ $wireTarget }}">{{ $buttonText }}</span>
    <span wire:loading wire:target="{{ $wireTarget }}">{{ $pendingText }}</span>
</button>
