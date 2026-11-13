@props([
    'icon',
])

<span
    class="bg-brand/12 text-brand-ink inset-ring-brand/25 inline-flex size-8 flex-none items-center justify-center rounded-lg inset-ring"
    aria-hidden="true"
>
    <flux:icon
        class="size-4"
        :$icon
    />
</span>
