@props([
    'bare' => false,
])

<div
    aria-hidden="true"
    {{ $attributes->class(['pointer-events-none absolute inset-x-0 bottom-0 h-px print:hidden', 'bg-line' => ! $bare]) }}
>
    <flux:icon.plus-mark class="text-brand absolute -top-1.5 -left-[7px] hidden sm:block" />
    <flux:icon.plus-mark class="text-brand absolute -top-1.5 -right-[7px] hidden sm:block" />
</div>
