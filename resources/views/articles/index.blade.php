@php
    use App\Seo\Seo;

    $breadcrumbs = ['homepage' => 'Home', 'articles' => 'Articles'];
@endphp

<x-layout.main
    :schema="[
        [
            ...Seo::webPage('CollectionPage', 'articles'),
            'mainEntity' => [
                '@type' => 'ItemList',
                'itemListElement' => $articles->map(fn ($article, $index) => [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'item' => ['@id' => $article->url() . '#article'],
                    'url' => $article->url(),
                    'name' => $article->h1,
                ])->all(),
            ],
        ],
        Seo::breadcrumbs($breadcrumbs),
    ]"
>
    <main>
        <x-page-head
            title="Articles"
            label=""
            :$breadcrumbs
        >
            <flux:text class="lede">
                Notes on running and upgrading Laravel and PHP apps in production, from client work and my own servers.
            </flux:text>
        </x-page-head>

        <section class="relative px-6 py-10 sm:px-10 sm:py-12 lg:px-14">
            <ul
                class="flex max-w-[72ch] flex-col gap-8"
                role="list"
            >
                @foreach ($articles as $article)
                    <li class="flex flex-col gap-2">
                        <flux:heading
                            class="text-ink screen:font-bold text-2xl/snug"
                            level="2"
                            size="xl"
                        >
                            <flux:link
                                href="{{ $article->url() }}"
                                wire:navigate.hover
                            >
                                {{ $article->h1 }}
                            </flux:link>
                        </flux:heading>
                        <p class="font-roboto-mono text-muted text-xs tracking-[0.04em]">
                            <time datetime="{{ $article->publishedAt->toDateString() }}">
                                {{ $article->publishedAt->format('j F Y') }}
                            </time>
                        </p>
                        <flux:text class="copy">{{ $article->description }}</flux:text>
                    </li>
                @endforeach
            </ul>
        </section>
    </main>
</x-layout.main>
