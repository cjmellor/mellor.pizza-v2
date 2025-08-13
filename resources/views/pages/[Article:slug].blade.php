<x-layout.main sub-title="{{ $article->title }}">
    <x-header />

    <article
        class="prose sm:prose-base lg:prose-lg xl:prose-xl 2xl:prose-2xl dark:prose-invert prose-a:no-underline prose-a:hover:underline prose-code:bg-pizza/30 prose-code:px-1.5 prose-code:font-roboto-mono prose-code:text-pizza prose-code:before:content-none prose-code:after:content-none prose-pre:px-0 sm:prose-pre:px-0 lg:prose-pre:px-0 xl:prose-pre:px-0 2xl:prose-pre:px-0 dark:prose-a:hover:decoration-pizza-dark dark:prose-code:bg-pink-900/30 dark:prose-code:text-pink-600 mx-4 mt-60 sm:mx-auto sm:mt-12 sm:mb-24"
    >
        <header class="mt-24 flex flex-col gap-y-6 sm:mt-0">
            <time
                class="flex items-center text-base text-zinc-400 dark:text-zinc-500"
                datetime="{{ $article->published_at->format('F jS, Y') }}"
            >
                <span class="h-4 w-0.5 rounded-full bg-zinc-200 dark:bg-zinc-500"></span>
                <span class="ml-3">{{ $article->published_at->format('F jS, Y') }}</span>
            </time>
            <h1 class="font-bold tracking-tight text-balance text-zinc-800 sm:text-5xl dark:text-zinc-100">{{ $article->title }}</h1>
        </header>
        {!! $article->content() !!}
    </article>
</x-layout.main>
