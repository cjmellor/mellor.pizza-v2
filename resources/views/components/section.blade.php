@props([
    'label',
    'title',
    'contact' => false,
])

<section
    {{
        $attributes->class([
            'relative flex flex-wrap gap-x-14 gap-y-6 px-6 py-10 sm:px-10 sm:py-12 lg:gap-y-8 lg:px-14 print:block print:p-0',
            'isolate' => $contact,
        ])
    }}
>
    @if ($contact)
        <div
            class="bg-grid pointer-events-none absolute inset-0 -z-10 [mask-image:linear-gradient(90deg,transparent_45%,#000)] bg-[position:right_-1px_top_-1px] [--grid-color:var(--color-grid-brand)] [--grid-size:24px] print:hidden"
            aria-hidden="true"
        ></div>
    @endif

    <div class="flex flex-[1_1_240px] flex-col gap-4 print:block">
        <hgroup class="flex flex-col gap-2 print:block">
            @if ($eyebrow = preg_replace('/^\d+\s*(—\s*)?/u', '', $label))
                <span class="eyebrow print:hidden">{{ $eyebrow }}</span>
            @endif

            <flux:heading
                class="text-ink screen:font-bold print:text-pizza print:border-pizza/40 text-3xl print:mb-2 print:border-b print:pb-1 print:text-lg print:font-bold"
                level="2"
                size="xl"
            >
                {{ $title }}
            </flux:heading>
        </hgroup>
        {{ $aside ?? '' }}
    </div>

    <div class="flex min-w-0 flex-[999_1_560px] flex-col gap-6 print:block">
        {{ $slot }}
    </div>

    <x-rule />
</section>
