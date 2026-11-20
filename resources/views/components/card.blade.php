@props([
    'heading' => null,
    'subheading' => null,
    'icon' => null,
    'logo' => null,
    'href' => null,
])

<flux:card
    {{ $attributes->class('bg-panel flex flex-col') }}
    body="divided"
    variant="muted"
>
    @if ($heading)
        <flux:card.header class="flex flex-wrap items-center gap-3 bg-transparent">
            @if ($icon)
                <x-chip :$icon />
            @endif

            @if ($logo)
                <img
                    class="size-8 flex-none rounded-full object-cover ring-1 ring-zinc-900/10"
                    src="{{ $logo }}"
                    alt="{{ $heading }} logo"
                />
            @endif

            <div class="min-w-0 flex-1">
                <flux:card.heading level="3">{{ $heading }}</flux:card.heading>
                @if ($subheading)
                    <flux:card.subheading class="truncate">{{ $subheading }}</flux:card.subheading>
                @endif
            </div>

            {{ $actions ?? '' }}

            @if ($href)
                <flux:card.actions>
                    <flux:button
                        href="{{ $href }}"
                        aria-label="Visit {{ $heading }} (opens in a new tab)"
                        size="sm"
                        variant="ghost"
                        icon="external-link"
                        target="_blank"
                        rel="noopener"
                    />
                </flux:card.actions>
            @endif
        </flux:card.header>
    @endif

    <flux:card.body @class(['text-body flex-1 text-sm/7', 'pb-4' => isset($footer)])>
        {{ $slot }}
    </flux:card.body>

    @isset($footer)
        <flux:card.footer class="text-body border-t-0! bg-transparent pt-0 text-sm/6.5">
            {{ $footer }}
        </flux:card.footer>
    @endisset
</flux:card>
