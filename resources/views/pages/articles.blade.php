<?php

use App\Models\Article;

use function Laravel\Folio\name;
use function Laravel\Folio\render;

name('articles');

render(function (Illuminate\View\View $view, Article $article): void {
    $view->with(
        key: 'articles',
        value: $article
            ->latest('published_at')
            ->where('visibility', 'public')
            ->simplePaginate(perPage: 10),
    );
});

?>

<x-layout.main sub-title="Web Development Articles & Tutorials">
    <x-header />

    <div class="dark:bg-dark bg-white pt-60 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-5xl">
                <h2
                    class="font-merriweather text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-zinc-100"
                >
                    Web Development Notes
                </h2>
                <p class="mt-6 text-lg/8 text-gray-600 dark:text-zinc-400">
                    Documenting my coding adventures and sharing what I've learned along the way
                </p>

                <div class="mt-16 flex flex-col gap-16">
                    @foreach ($articles as $article)
                        <article class="flex max-w-xl flex-col items-start justify-between text-balance">
                            <div class="flex items-center gap-x-4 text-xs">
                                <time
                                    class="relative mb-3 pl-3.5 text-sm text-zinc-400 dark:text-zinc-500"
                                    datetime="{{ $article->published_at->format('Y-m-d') }}"
                                >
                                    <span
                                        class="absolute inset-y-0 left-0 flex items-center"
                                        aria-hidden="true"
                                    >
                                        <span class="h-4 w-0.5 rounded-full bg-zinc-200 dark:bg-zinc-500"></span>
                                    </span>
                                    {{ $article->published_at->format('F jS, Y') }}
                                </time>
                            </div>
                            <div>
                                <h3 class="mt-3 text-lg/6 font-semibold">
                                    <x-link
                                        class="dark:text-zinc-100"
                                        :to="$article->slug"
                                        wire:navigate.hover
                                    >
                                        {{ $article->title }}
                                    </x-link>
                                </h3>
                                <p class="mt-5 text-sm/6 text-gray-600 dark:text-zinc-400">
                                    {{ $article->excerpt }}
                                </p>
                            </div>
                            <a
                                class="text-pizza dark:text-pizza-dark mt-4 hover:underline"
                                href="{{ $article->slug }}"
                                wire:navigate.hover
                            >
                                Read article &rarr;
                            </a>
                        </article>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.main>
