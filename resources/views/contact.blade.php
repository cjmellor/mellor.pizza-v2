<x-layout.main
    container
    :schema="[App\Seo\Seo::webPage('ContactPage', 'contact')]"
>
    <x-header />

    <main class="font-merriweather relative container my-20 mt-12 space-y-10 px-4 pt-0 md:px-12 lg:mt-0 lg:pt-40">
        <section class="space-y-6">
            <h1 class="text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100">Tell me what you're building</h1>
            <p class="flex items-center gap-2 text-zinc-600 dark:text-zinc-400">
                <span class="size-2.5 rounded-full bg-lime-500 dark:bg-lime-300"></span>
                Available now · I reply the same day
            </p>
            <div class="flex flex-wrap items-center gap-4">
                <flux:button
                    href="mailto:chris@mellor.pizza"
                    icon="envelope"
                >
                    chris@mellor.pizza
                </flux:button>
                <flux:button
                    href="https://www.linkedin.com/in/chrismellor85"
                    variant="ghost"
                    target="_blank"
                >
                    LinkedIn
                </flux:button>
            </div>
        </section>

        <livewire:contact-popup inline />
    </main>
</x-layout.main>
