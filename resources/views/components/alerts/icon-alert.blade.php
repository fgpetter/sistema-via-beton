@props(['type', 'message'])

<div {{ $attributes->merge(['class' => "mb-4 px-4 py-3 text-sm rounded-md text-{$type} bg-{$type}/10 border border-{$type} flex items-center gap-1"]) }}>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
    <span> {{ $message }} </span>
</div>