<!DOCTYPE html>
<html
    class="antialiased"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
    <head>
        <meta charset="utf-8" />
        @yield('meta-description')
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        />
        <title>Mellor.🍕 - {{ $subTitle ?? "Chris Mellor's Website & Blog" }}</title>

        <x-tracking-code />

        <meta
            property="og:title"
            content="Mellor.🍕 - {{ $subTitle ?? "Chris Mellor's Website & Blog" }}"
        />
        <meta
            property="og:description"
            content="The personal website and blog writings of Chris Mellor"
        />
        <meta
            property="og:url"
            content="https://mellor.pizza/"
        />
        <meta
            property="og:site_name"
            content="Mellor.🍕"
        />
        <meta
            property="og:locale"
            content="en_GB"
        />
        <meta
            property="og:image"
            content="{{ asset('storage/open_graph_image.jpg') }}"
        />
        <meta
            property="og:type"
            content="website"
        />

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
