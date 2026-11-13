@props([
    'label',
    'title',
    'button',
])

<x-section
    :$label
    :$title
    contact
>
    <div class="flex flex-1 flex-col items-start justify-end gap-4">
        <p class="text-ink-soft max-w-[56ch] text-lg/relaxed">{{ $slot }}</p>
        <flux:button
            class="max-sm:self-stretch"
            href="{{ route('contact') }}"
            variant="primary"
            wire:navigate.hover
        >
            {{ $button }}
        </flux:button>
    </div>
</x-section>
