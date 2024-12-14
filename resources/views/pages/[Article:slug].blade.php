<x-layout.main sub-title="{{ $article->title }}">
    <x-header />

    <article class="mx-4 mt-6 max-w-prose sm:mx-auto sm:mt-12 sm:mb-24 prose prose-sm prose-pre:px-0 prose-a:text-pop prose-a:no-underline prose-code:text-pizza prose-code:bg-pizza/30 prose-code:px-1.5 prose-code:font-roboto-mono prose-code:before:content-none prose-code:after:content-none sm:prose-base sm:prose-pre:px-0 lg:prose-lg lg:prose-pre:px-0 xl:prose-xl xl:prose-pre:px-0 2xl:prose-2xl 2xl:prose-pre:px-0 dark:prose-invert dark:hover:prose-a:decoration-pizza-dark dark:prose-code:text-pink-600 dark:prose-code:bg-pink-900/30 hover:prose-a:underline">
        {!! $article->content() !!}
    </article>
</x-layout.main>
