@props([
    'menu' => false,
])

@php
    $links = [
        'cv' => 'View CV',
        'portfolio' => 'Portfolio',
        'app-security-review' => 'Security review',
    ];
@endphp

<div
    @class(['contents' => $menu, 'nav:order-3 nav:flex nav:basis-full nav:border-t nav:border-line hidden lg:order-2 lg:flex-initial lg:basis-auto lg:border-t-0' => ! $menu])
>
    @foreach ($links as $route => $label)
        <x-site.nav-item
            :href="route($route)"
            :index="$loop->iteration"
            :current="request()->routeIs($route)"
            :$menu
            wire:navigate.hover
        >
            {{ $label }}
        </x-site.nav-item>
    @endforeach
</div>

<x-site.nav-item
    :href="route('contact')"
    :index="count($links) + 1"
    :current="request()->routeIs('contact')"
    :$menu
    cta
    wire:navigate.hover
>
    Contact.Me
</x-site.nav-item>
