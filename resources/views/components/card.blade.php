@props([
    'heading' => null,
    'subheading' => null,
    'icon' => null,
    'logo' => null,
    'href' => null,
])

<flux:card
    {{ $attributes->class('bg-panel hover:border-brand/45 flex flex-col transition-colors duration-150') }}
    body="inset"
    variant="muted"
>
    @if ($heading)
        <flux:card.header class="flex flex-wrap items-center gap-3">
            @if ($icon)
                <x-chip :$icon />
            @endif

            @if ($logo)
                <img
                    class="size-8 flex-none rounded-full object-cover ring-1 ring-zinc-900/10"
                    src="{{ $logo }}"
                    alt=""
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

    <flux:card.body class="text-body flex-1 text-sm/7">
        {{ $slot }}
    </flux:card.body>

    @isset($footer)
        <flux:card.footer class="text-body text-sm/relaxed">
            {{ $footer }}
        </flux:card.footer>
    @endisset
</flux:card>
