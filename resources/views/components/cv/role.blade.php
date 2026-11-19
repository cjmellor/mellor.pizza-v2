@props([
    'title',
    'dates',
    'org' => null,
    'context' => null,
    'current' => false,
    'nested' => false,
    'group' => false,
])

<flux:timeline.item
    :status="$current ? 'current' : 'complete'"
    @class([
        'border-line',
        'phone:not-first:mt-8 phone:not-first:border-t phone:not-first:pt-8' => ! $nested,
        'phone:border-t phone:border-dashed phone:pt-5 phone:not-first:mt-6' => $nested,
    ])
>
    <flux:timeline.indicator variant="bare">
        <div
            @class([
                'rounded-full',
                $nested ? 'mt-[7px] size-2.5' : 'mt-2 size-3',
                'bg-pizza ring-pizza/20 dark:bg-pizza-dark dark:ring-pizza-dark/20 ring-4' => $current,
                'dark:bg-dark border-2 border-zinc-300 bg-white dark:border-zinc-600' => ! $current,
            ])
        ></div>
    </flux:timeline.indicator>

    <flux:timeline.content>
        <div class="flex flex-wrap items-baseline justify-between gap-x-4">
            <{{ $nested ? 'h4' : 'h3' }}
                @class(['text-ink font-semibold print:text-black', 'print:text-sm' => $nested, 'phone:text-xl text-lg print:text-base' => ! $nested])
            >
                {{ $title }}
            </{{ $nested ? 'h4' : 'h3' }}>
            <p
                @class([
                    'screen:font-roboto-mono screen:tracking-[0.02em] text-muted text-xs tabular-nums print:text-black',
                    'print:font-semibold' => $current,
                ])
            >
                {{ $dates }}
            </p>
        </div>

        @if ($org)
            <p
                @class([
                    'text-brand-ink screen:mt-1 text-[15px] font-bold tracking-[0.01em] print:text-sm print:tracking-normal print:text-black',
                    'print:font-medium' => $nested,
                    'print:font-semibold' => ! $nested,
                ])
            >
                {{ $org }}
            </p>
        @endif

        @if ($context)
            <p class="text-body phone:text-base mt-2 text-[15px]/[1.7] print:mt-1 print:text-sm print:text-black">{{ $context }}</p>
        @endif

        @if ($group)
            {{ $slot }}
        @else
            <ul
                class="text-body screen:marker:text-brand phone:text-base mt-2.5 list-outside list-disc space-y-2 pl-5 text-[15px]/[1.7] print:mt-1 print:space-y-1 print:text-sm print:leading-snug print:text-black"
            >
                {{ $slot }}
            </ul>
        @endif
    </flux:timeline.content>
</flux:timeline.item>
