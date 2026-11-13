@props([
    'label',
    'title',
])

<section
    {{ $attributes->class('rise-stagger relative flex flex-col gap-4 px-6 pt-12 pb-10 sm:px-10 sm:pt-14 sm:pb-12 lg:gap-5 lg:px-14 lg:pt-18 lg:pb-14') }}
>
    <span class="eyebrow print:hidden">{{ $label }}</span>
    <h1 class="text-4xl/tight font-black tracking-[-0.01em] lg:text-5xl/tight print:text-4xl print:font-bold print:tracking-normal">
        {{ $title }}
    </h1>
    {{ $slot }}
    <x-rule bare />
</section>
