@props([
    'label',
    'title',
    'contact' => false,
])

<section
    {{
        $attributes->class([
            'relative flex flex-wrap gap-x-14 gap-y-6 px-6 py-12 sm:px-10 sm:py-14 lg:gap-y-8 lg:px-14 lg:py-16 print:block print:p-0',
            'bg-grid bg-center [--grid-color:var(--color-grid-brand)] [--grid-size:24px]' => $contact,
        ])
    }}
>
    <div class="flex flex-[1_1_240px] flex-col gap-2 print:block">
        <span class="eyebrow print:hidden">{{ $label }}</span>
        <h2 class="text-ink print:text-pizza print:border-pizza/40 text-3xl font-bold print:mb-2 print:border-b print:pb-1 print:text-lg">
            {{ $title }}
        </h2>
        {{ $aside ?? '' }}
    </div>

    <div class="flex min-w-0 flex-[999_1_560px] flex-col gap-6 print:block">
        {{ $slot }}
    </div>

    <x-rule />
</section>
