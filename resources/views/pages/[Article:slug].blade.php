<x-layout.main sub-title="{{ $article->title }}">
    <x-header />

    <article
        class="prose mx-4 mt-6 sm:prose-base lg:prose-lg xl:prose-xl 2xl:prose-2xl dark:prose-invert prose-a:no-underline hover:prose-a:underline prose-code:bg-pizza/30 prose-code:px-1.5 prose-code:font-roboto-mono prose-code:text-pizza prose-code:before:content-none prose-code:after:content-none prose-pre:px-0 sm:mx-auto sm:mb-24 sm:mt-12 sm:prose-pre:px-0 lg:prose-pre:px-0 xl:prose-pre:px-0 2xl:prose-pre:px-0 dark:hover:prose-a:decoration-pizza-dark dark:prose-code:bg-pink-900/30 dark:prose-code:text-pink-600"
    >
        <header class="flex flex-col gap-y-6">
            <time
                datetime="{{ $article->published_at->format('F jS, Y') }}"
                class="flex items-center text-base text-zinc-400 dark:text-zinc-500"
            >
                <span class="h-4 w-0.5 rounded-full bg-zinc-200 dark:bg-zinc-500"></span>
                <span class="ml-3">{{ $article->published_at->format('F jS, Y') }}</span>
            </time>
            <h1 class="text-balance font-bold tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100">{{ $article->title }}</h1>
        </header>
        {!! $article->content() !!}
    </article>
</x-layout.main>
