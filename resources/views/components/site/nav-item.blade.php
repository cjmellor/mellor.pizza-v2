@props([
    'href',
    'current' => false,
    'cta' => false,
    'menu' => false,
])

@php
    $bar = ! $menu;
@endphp

<a
    href="{{ $href }}"
    @if ($current) aria-current="page" @endif
    {{
        $attributes->class([
            'group font-roboto-mono relative items-center gap-2 text-sm tracking-[0.04em] uppercase transition-colors duration-150 focus-visible:outline-none',
            'after:bg-brand after:absolute after:inset-x-0 after:-bottom-px after:h-0.5 after:origin-right after:scale-x-0 after:transition-transform after:duration-220 after:ease-(--ease-out-strong) hover:after:origin-left hover:after:scale-x-100 focus-visible:after:scale-x-100 focus-visible:after:transition-none',
            'motion-reduce:after:scale-x-100 motion-reduce:after:opacity-0 motion-reduce:after:transition-opacity motion-reduce:hover:after:opacity-100 motion-reduce:focus-visible:after:opacity-100',
            'after:scale-x-100 motion-reduce:after:opacity-100' => $current,
            'flex' => $menu || ! $cta,
            'text-ink-soft hover:bg-brand/6 hover:text-ink focus-visible:bg-brand/6 focus-visible:text-ink' => ! $cta,
            'text-ink' => $current && ! $cta,
            'border-line short:min-h-12 min-h-14 justify-start border-b px-5 last:border-b-0' => $menu,
            'text-brand-ink hover:bg-brand/6 focus-visible:bg-brand/6' => $menu && $cta,
            'border-line justify-center border-l px-6' => $bar,
            'nav:min-h-14 nav:flex-1 nav:first:border-l-0 lg:min-h-18 lg:flex-auto lg:px-5 lg:first:border-l xl:px-6' => $bar && ! $cta,
            'nav:order-2 nav:flex nav:flex-none bg-brand hover:bg-brand-hover focus-visible:bg-brand-hover hidden text-white after:bg-white lg:order-3 lg:px-5 xl:px-6' => $bar && $cta,
        ])
    }}
>
    {{ $slot }}
</a>
