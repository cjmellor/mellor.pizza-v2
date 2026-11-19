@props([
    'trail',
])

<nav
    class="font-roboto-mono text-body text-xs tracking-[0.04em] print:hidden"
    aria-label="Breadcrumb"
>
    <ol class="flex flex-wrap items-center gap-x-2 gap-y-1">
        @foreach ($trail as $target => $label)
            <li class="flex items-center gap-2">
                @if ($loop->last)
                    <span aria-current="page">{{ $label }}</span>
                @else
                    <flux:link
                        href="{{ App\Seo\Seo::breadcrumbUrl($target) }}"
                        variant="ghost"
                        wire:navigate.hover
                    >
                        {{ $label }}
                    </flux:link>
                    <span aria-hidden="true">›</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
