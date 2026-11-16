@props([
    'label',
    'title',
])

<section
    {{ $attributes->class('rise-stagger relative flex flex-col gap-6 px-6 pt-12 pb-10 sm:px-10 sm:pt-14 sm:pb-12 lg:gap-8 lg:px-14 lg:pt-18 lg:pb-14 print:gap-4') }}
>
    <hgroup class="flex flex-col gap-3">
        @if ($eyebrow = preg_replace('/^\d+\s*(—\s*)?/u', '', $label))
            <span class="eyebrow print:hidden">{{ $eyebrow }}</span>
        @endif

        <flux:heading
            class="text-ink screen:font-black text-4xl/tight tracking-[-0.01em] lg:text-5xl/tight print:text-4xl print:font-bold print:tracking-normal print:text-black"
            level="1"
            size="2xl"
        >
            {{ $title }}
        </flux:heading>
    </hgroup>
    {{ $slot }}
    <x-rule bare />
</section>
