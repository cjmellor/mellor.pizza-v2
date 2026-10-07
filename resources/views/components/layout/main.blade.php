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
        <title>Mellor.🍕 - {{ $subTitle ?? "Chris Mellor's Website" }}</title>

        <!-- Facebook Meta Tags -->
        <meta
            property="og:url"
            content="https://mellor.pizza"
        />
        <meta
            property="og:type"
            content="website"
        />
        <meta
            property="og:title"
            content="Mellor.🍕 - {{ $subTitle ?? "Chris Mellor's Website" }}"
        />
        <meta
            property="og:description"
            content="Chris Mellor, Laravel engineer and founder of Kandu. Portfolio and CV."
        />
        <meta
            property="og:image"
            content="https://mellor.pizza/images/open_graph_image.jpg"
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
            content="https://mellor.pizza"
        />
        <meta
            name="twitter:title"
            content="Mellor.🍕 - {{ $subTitle ?? "Chris Mellor's Website" }}"
        />
        <meta
            name="twitter:description"
            content="Chris Mellor, Laravel engineer and founder of Kandu. Portfolio and CV."
        />
        <meta
            name="twitter:image"
            content="{{ asset('images/open_graph_image.jpg') }}"
        />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('stylesheets')
        @fluxAppearance

        @if (config('services.umami.website_id'))
            <script
                defer
                src="{{ config('services.umami.script_url') }}"
                data-website-id="{{ config('services.umami.website_id') }}"
            ></script>
        @endif
    </head>

    <body>
        <x-toast />

        <div {{ $attributes->class(['dark:text-dark-gray dark:text-opacity-70 mx-auto pt-8 pb-4', 'container' => $container ?? '']) }}>
            {{ $slot }}

            <livewire:contact-popup />

            <footer class="mx-8 mt-16 text-center text-xs text-neutral-500 lg:mx-0 dark:text-neutral-400">
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
