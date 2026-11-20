@props([
    'heading',
    'subheading',
    'badge',
    'href' => null,
])

<article
    {{ $attributes->class('bg-panel relative overflow-hidden rounded-xl border border-zinc-900/10 dark:border-white/10') }}
>
    <div
        class="relative h-28 overflow-hidden [mask-image:linear-gradient(to_bottom,#000,transparent)]"
        aria-hidden="true"
    >
        {{ $cover }}
    </div>

    <div class="relative z-10 -mt-8 px-6 pb-6">
        <span
            class="bg-panel text-brand-ink inset-ring-brand/35 ring-panel flex size-16 items-center justify-center overflow-hidden rounded-lg ring-4 inset-ring"
            aria-hidden="true"
        >
            {{ $icon }}
        </span>

        <div class="mt-4 flex items-center gap-3">
            <h3 class="text-ink flex-1 text-base/6 font-bold">{{ $heading }}</h3>
            <flux:badge
                class="bg-brand/12! text-brand-ink! inset-ring-brand/25 px-2! py-px! inset-ring"
                size="sm"
                rounded
            >
                {{ $badge }}
            </flux:badge>

            @if ($href)
                <flux:button
                    class="-my-2 -mr-2"
                    href="{{ $href }}"
                    aria-label="Visit {{ $heading }} (opens in a new tab)"
                    size="sm"
                    variant="ghost"
                    icon="external-link"
                    target="_blank"
                    rel="noopener"
                />
            @else
                <span
                    class="-my-2 -mr-2 size-8 shrink-0"
                    aria-hidden="true"
                ></span>
            @endif
        </div>
        <p class="text-muted mt-1 text-sm/6">{{ $subheading }}</p>
        <p class="text-body mt-4 text-sm/7">{{ $slot }}</p>
    </div>
</article>
