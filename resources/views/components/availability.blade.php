@props([
    'dot' => false,
])

<flux:text {{ $attributes->class('flex flex-wrap items-center') }}>
    @if ($dot)
        <span
            class="mr-2 size-2 rounded-full bg-lime-500 dark:bg-lime-300"
            aria-hidden="true"
        ></span>
    @endif
    Available now
    <span
        class="mx-3"
        aria-hidden="true"
    >
        ·
    </span>
    I reply the same day
</flux:text>
