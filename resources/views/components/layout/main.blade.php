@use(App\Seo\Seo)

@props([
    'schema' => [],
])

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
        @head

        <script type="application/ld+json">
            {!! Seo::jsonLd($schema) !!}
        </script>

        <script>
            document.documentElement.classList.add('fonts-loading');
            addEventListener('DOMContentLoaded', () => {
                Promise.race([
                    Promise.all(['900 1em Merriweather', '1em Merriweather', '1em "Roboto Mono"'].map((font) => document.fonts.load(font))),
                    new Promise((resolve) => setTimeout(resolve, 500)),
                ]).finally(() => requestAnimationFrame(() => document.documentElement.classList.remove('fonts-loading')));
            });
        </script>
        <link
            href="https://fonts.googleapis.com/css2?family=Anton&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"
        />
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

    <body class="bg-canvas text-ink print:bg-white print:text-black">
        @persist('toast')
            <flux:toast />
        @endpersist

        <div class="relative min-h-screen overflow-x-clip">
            <div
                class="screen:font-merriweather sm:screen:w-[min(1280px,calc(100%-48px))] sm:screen:border-x sm:screen:border-line relative mx-auto w-full print:container print:pt-8 print:pb-4"
            >
                <div
                    class="bg-grid pointer-events-none absolute inset-x-0 top-0 h-190 [mask-image:radial-gradient(ellipse_70%_60%_at_50%_40%,#000_25%,transparent_100%)] bg-top print:hidden"
                    aria-hidden="true"
                ></div>
                <div
                    class="pointer-events-none absolute top-35 left-1/2 h-125 w-[min(860px,100%)] -translate-x-1/2 bg-[radial-gradient(closest-side,var(--color-glow),transparent)] print:hidden"
                    aria-hidden="true"
                ></div>

                <x-site.header />

                {{ $slot }}

                <footer
                    class="screen:m-0 screen:flex screen:flex-wrap screen:justify-center screen:gap-3 screen:p-6 screen:font-roboto-mono screen:leading-relaxed screen:text-muted sm:screen:px-10 lg:screen:px-14 lg:screen:justify-between lg:screen:text-left mx-8 mt-16 text-center text-xs text-neutral-500 lg:mx-0 print:mt-6"
                >
                    <p class="screen:flex screen:flex-col">
                        <span>
                            <span class="whitespace-nowrap">&copy; {{ date('Y') }} Mellor Code Ltd.</span>
                            <span class="whitespace-nowrap">Registered in England and Wales,</span>
                            <span class="whitespace-nowrap">company no. 17369266.</span>
                        </span>
                        <br class="screen:hidden sm:hidden" />
                        <span>
                            <span class="whitespace-nowrap">Registered office: {{ config('seo.organization.street_address') }},</span>
                            <span class="whitespace-nowrap">
                                {{ config('seo.organization.district') }}, {{ config('seo.organization.locality') }},
                                {{ config('seo.organization.postal_code') }}.
                            </span>
                        </span>
                    </p>
                    <span class="screen:flex screen:gap-6">
                        <flux:link
                            class="text-inherit"
                            href="{{ route('privacy') }}"
                            wire:navigate.hover
                        >
                            Privacy policy
                        </flux:link>
                        @if (App\Articles\Article::published()->isNotEmpty())
                            <flux:link
                                class="text-inherit"
                                href="{{ route('articles') }}"
                                wire:navigate.hover
                            >
                                Articles
                            </flux:link>
                        @endif
                    </span>
                </footer>
            </div>
        </div>

        @stack('scripts')
        @fluxScripts
    </body>
</html>
