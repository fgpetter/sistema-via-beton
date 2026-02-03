---
alwaysApply: true
---

## Livewire Instructions

- Use `vendor/bin/sail artisan make:livewire [Namespace\ComponentName]` to create new components.
- Always use class-based components, never Volt.
- Livewire components require a single root element in the Blade template.
- All Livewire requests hit the Laravel backend - always validate form data and run authorization checks in Livewire actions.

---

### wire:model Modifiers

- `wire:model` is deferred by default - only syncs on form submission or action calls.
- Use `wire:model.live` for real-time updates on every keystroke.
- Use `wire:model.blur` to sync only when input loses focus.
- Use `wire:model.live.debounce.500ms` for debounced live updates.
- Prefer `.blur` or `.debounce` over `.live` without debounce to reduce network requests.

---

### wire:key in Loops

Always add `wire:key` in loops to help Livewire track elements: `wire:key="item-{{ $item->id }}"`.

---

### Loading States

- Use `wire:loading` and `wire:target` for loading indicators.
- Use `wire:loading.attr="disabled"` to disable buttons during requests.
- Prefer Tailwind's `data-loading:opacity-50` over `wire:loading` for simpler cases.

---

### Lifecycle Hooks

- Use `mount()` for initialization with route parameters.
- Use `updated{Property}()` for reactive side effects when a specific property changes.
- Use `updating{Property}()` to intercept before a property changes.

---

### Computed Properties

- Use `#[Computed]` for expensive operations that should be memoized.
- Access in Blade with `$this->posts` (not `$posts`).
- Computed properties are cached within a single request.

---

### Form Validation

- Use `#[Validate('required|min:3')]` attribute on properties for inline validation.
- Call `$this->validate()` before persisting data.
- For complex forms, use Livewire Form Objects.

---

### Events and Communication

- Use `$this->dispatch('event-name', data: $value)` to dispatch events.
- Use `#[On('event-name')]` attribute to listen for events in another component.

---

### Modelable Child Components

Use `#[Modelable]` for reusable input components that work with `wire:model`:

```php
// Child component
#[Modelable]
public $value = '';
```

```blade
<livewire:custom-input wire:model="name" />
```

---

### Security

- Use `#[Locked]` for properties that should not be modified from the client.
- Eloquent models as properties are automatically locked.
- Always authorize actions before database operations.

---

### Nested Components vs Islands

**Use Islands when:** performance isolation without complexity, defer/lazy load content, region doesn't need own lifecycle.

**Use Nested Components when:** reusable self-contained functionality, separate lifecycle hooks, encapsulated state and logic.

---

## Performance

### Use Alpine for Client-Side Only Interactions

Always use Alpine.js for interactions that don't require database queries or server-side logic:

```blade
{{-- ✅ Good: Toggle handled by Alpine --}}
<div x-data="{ showDetails: false }">
    <button @click="showDetails = !showDetails">Toggle</button>
    <div x-show="showDetails">Details...</div>
</div>

{{-- ❌ Bad: Unnecessary server round-trip --}}
<button wire:click="toggleDetails">Toggle</button>
@if($showDetails) <div>Details...</div> @endif
```

---

### Prefetch Data for Autocomplete/Suggestions

For input suggestions, load data once from backend and filter client-side:

```blade
{{-- ✅ Good: Load once, filter with Alpine --}}
<div x-data="{
    search: '',
    items: @js($items),
    get filtered() {
        if (!this.search) return [];
        return this.items.filter(i => 
            i.toLowerCase().includes(this.search.toLowerCase())
        ).slice(0, 10);
    }
}">
    <input type="text" x-model="search">
    <template x-for="item in filtered" :key="item">
        <li @click="$wire.selectedItem = item" x-text="item"></li>
    </template>
</div>

{{-- ❌ Bad: Server request on every keystroke --}}
<input type="text" wire:model.live="search">
```

---

### Avoid wire:model.live Without Debounce

```blade
{{-- ✅ Good --}}
<input wire:model.live.debounce.300ms="search">
<input wire:model.blur="email">

{{-- ❌ Bad: Request on every keystroke --}}
<input wire:model.live="search">
```

---

### Lazy Load Heavy Components

```blade
<livewire:heavy-component lazy />
<livewire:dashboard-stats lazy="on-load" />
```

---

### Skip Re-renders for JavaScript-Only Actions

Use `#[Renderless]` for actions that don't need to update the UI (analytics, logging, etc.).

---

## Alpine.js Instructions

- Alpine is bundled with Livewire - don't manually include it.
- Use `x-data` to declare reactive state.
- Use `x-show` for frequently toggled elements (CSS toggle, stays in DOM).
- Use `x-if` inside `<template>` for elements that rarely change (removed from DOM).
- Use `x-transition` for smooth animations.

---

### Accessing Livewire from Alpine ($wire)

```blade
<div x-data="{ localValue: '' }">
    <span x-text="$wire.count"></span>
    <button @click="$wire.increment()">+</button>
    <button @click="$wire.count = 0">Reset</button>
    <button @click="localValue = await $wire.getValue()">Get</button>
</div>
```

---

### x-modelable for Custom Inputs

Use `x-modelable` to make Alpine components work with `wire:model`:

```blade
<div x-data="{ count: 0 }" x-modelable="count" {{ $attributes }}>
    <button @click="count--">-</button>
    <span x-text="count"></span>
    <button @click="count++">+</button>
</div>

{{-- Usage --}}
<x-counter-input wire:model="quantity" />
```

---

### Alpine.data() for Reusable Components

Register in `resources/js/app.js`:

```javascript
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

Alpine.data('dropdown', () => ({
    open: false,
    toggle() { this.open = !this.open },
    close() { this.open = false }
}));

Livewire.start();
```

---

### Event Modifiers

- `@click.prevent` - preventDefault()
- `@click.stop` - stopPropagation()
- `@click.outside` - click outside element
- `@click.once` - trigger only once
- `@keydown.enter`, `@keydown.escape` - key modifiers

---

### Included Alpine Plugins

Livewire includes: `persist`, `intersect`, `collapse`, `focus`.

- `x-intersect="$wire.loadMore()"` - lazy loading on scroll
- `x-collapse` - smooth accordion collapse
- `x-trap="open"` - focus trap for modals
- `$persist('value')` - persist to localStorage

---

## Combining Livewire and Alpine

### Optimistic UI Updates

```blade
<button
    wire:click="bookmark"
    x-data="{ bookmarked: @js($bookmarked) }"
    @click="bookmarked = !bookmarked"
    :class="{ 'text-yellow-500': bookmarked }"
>
    <span x-show="!bookmarked">☆</span>
    <span x-show="bookmarked">★</span>
</button>
```

---

## Testing Livewire Components

- Use `Livewire::test(Component::class)` to test components.
- Chain `->set('property', 'value')` to set properties.
- Chain `->call('method')` to call actions.
- Assert with `->assertHasErrors(['field'])`, `->assertSet('prop', 'value')`, `->assertRedirect()`.
- Test component exists on page with `->assertSeeLivewire(Component::class)`.
