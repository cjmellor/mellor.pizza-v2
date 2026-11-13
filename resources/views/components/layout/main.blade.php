@use(App\Seo\Seo)

@props([
    'container' => false,
    'schema' => [],
])

@php
    $page = Seo::page();
    $title = "Chris Mellor - {$page['title']}";
    $canonical = Seo::canonical();
    $ogImage = Seo::url('images/open_graph_image.jpg');
@endphp

<!DOCTYPE html>
<html
    class="antialiased"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        />
        <title>{{ $title }}</title>
        <meta
            name="description"
            content="{{ $page['description'] }}"
        />
        <link
            href="{{ $canonical }}"
            rel="canonical"
        />
        <link
            type="image/svg+xml"
            href="{{ asset('favicon.svg') }}"
            rel="icon"
        />

        <!-- Facebook Meta Tags -->
        <meta
            property="og:url"
            content="{{ $canonical }}"
        />
        <meta
            property="og:type"
            content="website"
        />
        <meta
            property="og:title"
            content="{{ $title }}"
        />
        <meta
            property="og:description"
            content="{{ $page['description'] }}"
        />
        <meta
            property="og:image"
            content="{{ $ogImage }}"
        />

        <!-- Twitter Meta Tags -->
        <meta
            name="twitter:card"
            content="summary_large_image"
        />
        <meta
            property="twitter:domain"
            content="mellor.pizza"
        />
        <meta
            property="twitter:url"
            content="{{ $canonical }}"
        />
        <meta
            name="twitter:title"
            content="{{ $title }}"
        />
        <meta
            name="twitter:description"
            content="{{ $page['description'] }}"
        />
        <meta
            name="twitter:image"
            content="{{ $ogImage }}"
        />

        <script type="application/ld+json">
            {!! Seo::jsonLd($schema) !!}
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('stylesheets')
        @fluxAppearance

        @if (config('services.umami.website_id'))
            <script
                data-website-id="{{ config('services.umami.website_id') }}"
                src="{{ config('services.umami.script_url') }}"
                defer
            ></script>
        @endif
    </head>

    <body>
        <x-toast />

        <div {{ $attributes->class(['dark:text-dark-gray dark:text-opacity-70 mx-auto pt-8 pb-4', 'container' => $container ?? '']) }}>
            {{ $slot }}

            <livewire:contact-popup />

            <footer class="mx-8 mt-16 text-center text-xs text-neutral-500 lg:mx-0 dark:text-neutral-400 print:mt-6">
                <p>
                    &copy; {{ date('Y') }} Mellor Code Ltd. Registered in England and Wales, company no. 17369266.
                    <br class="sm:hidden" />
                    Registered office: 17 Stroothers Place, Bradford, England, BD4 0BN.
                </p>
            </footer>
        </div>

        @stack('scripts')
        @fluxScripts
    </body>
</html>
