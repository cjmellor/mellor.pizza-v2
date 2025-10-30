<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        @yield('meta-description')
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        />
        <meta
            name="csrf-token"
            content="{{ csrf_token() }}"
        />
        <title>Mellor.🍕 - {{ $subTitle ?? 'Home' }}</title>

        <x-tracking-code />

        @yield('openGraph')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('stylesheets')
        @fluxAppearance
    </head>

    <body>
        <x-toast />
        <div {{ $attributes->class(['dark:text-dark-gray dark:text-opacity-70 mx-auto pt-8 pb-4', 'container' => $container ?? '']) }}>
            {{ $slot }}
            <livewire:contact-popup />
        </div>
        @stack('scripts')
        @fluxScripts
    </body>
</html>
