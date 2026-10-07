<x-layout.main
    container
    subTitle="Chris Mellor's Portfolio"
>
    <x-header />

    @section('meta-description')
        <meta
            name="description"
            content="Chris Mellor's portfolio: Kandu, a product in development, and selected client projects."
        />
    @endsection

    <!-- Main container -->
    <main class="relative container my-20 mt-12 space-y-6 px-4 pt-0 sm:space-y-20 md:px-12 lg:mt-0 lg:space-y-12 lg:pt-40">
        <div class="space-y-6">
            <h1 class="font-merriweather text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100">My portfolio</h1>
            <p class="text-lg leading-7 text-zinc-700 dark:text-zinc-300">
                A product I’m building, plus a selection of client projects—showcasing design, development, and problem‑solving across
                different briefs. More coming soon.
            </p>
        </div>

        <section class="space-y-6">
            <h2 class="font-merriweather text-2xl font-semibold text-zinc-800 dark:text-zinc-100">Building</h2>

            <flux:card
                class="max-w-xl"
                body="separated"
            >
                <flux:card.header class="flex items-center justify-between gap-4">
                    <div>
                        <flux:card.heading
                            size="lg"
                            level="3"
                        >
                            Kandu
                        </flux:card.heading>
                        <flux:card.subheading>Kanban project tracker</flux:card.subheading>
                    </div>
                    <flux:card.actions>
                        <flux:badge
                            size="sm"
                            color="amber"
                        >
                            In progress
                        </flux:badge>
                    </flux:card.actions>
                </flux:card.header>
                <flux:card.body>
                    <flux:text>A kanban project tracker built with Laravel, inspired by Fizzy. In development.</flux:text>
                </flux:card.body>
            </flux:card>
        </section>

        <section class="space-y-6">
            <h2 class="font-merriweather text-2xl font-semibold text-zinc-800 dark:text-zinc-100">Client projects</h2>

            <ul
                class="grid grid-cols-[repeat(auto-fill,minmax(min(19rem,100%),1fr))] gap-6 2xl:grid-cols-3"
                role="list"
            >
                @foreach (\App\Portfolio\Project::all()->reverse() as $project)
                    <li>
                        <flux:card
                            class="h-full"
                            body="separated"
                        >
                            <flux:card.header class="flex items-center gap-3">
                                <flux:avatar
                                    src="{{ $project->logo }}"
                                    alt="{{ $project->name }}"
                                    size="sm"
                                    circle
                                />
                                <div class="min-w-0 flex-1">
                                    <flux:card.heading level="3">{{ $project->name }}</flux:card.heading>
                                    @if ($project->url)
                                        <flux:card.subheading class="truncate">{{ $project->url }}</flux:card.subheading>
                                    @endif
                                </div>
                                @if ($project->url)
                                    <flux:card.actions>
                                        <flux:button
                                            href="{{ str_starts_with($project->url, 'http') ? $project->url : 'https://' . $project->url }}"
                                            aria-label="Visit {{ $project->name }}"
                                            size="sm"
                                            variant="ghost"
                                            icon="arrow-up-right"
                                            target="_blank"
                                        />
                                    </flux:card.actions>
                                @endif
                            </flux:card.header>
                            <flux:card.body>
                                <flux:text>{!! $project->description !!}</flux:text>
                            </flux:card.body>
                            @if ($project->testimonial)
                                <flux:card.footer>
                                    <flux:text class="italic">“{{ $project->testimonial }}”</flux:text>
                                </flux:card.footer>
                            @endif
                        </flux:card>
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="space-y-6 rounded-2xl bg-zinc-50 p-8 text-center ring-1 ring-zinc-200 dark:bg-zinc-900/40 dark:ring-zinc-700">
            <h2 class="font-merriweather text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Let’s work together</h2>
            <p class="mx-auto max-w-3xl text-base leading-7 text-zinc-600 dark:text-zinc-400">
                Got a brief in mind or want to chat through an idea? I’m open to freelance and contract opportunities.
            </p>
            <div>
                <flux:button
                    class="bg-pizza dark:bg-pizza-dark hover:bg-pizza/90 dark:hover:bg-pizza-dark/90"
                    variant="primary"
                    x-data
                    x-on:click.prevent="$dispatch('show-contact')"
                >
                    Contact me
                </flux:button>
            </div>
        </section>
    </main>
</x-layout.main>
