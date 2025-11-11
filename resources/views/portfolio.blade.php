<x-layout.main
    container
    subTitle="Chris Mellors' Portfolio"
>
    <x-header />

    @section('meta-description')
        <meta
            name="description"
            content="See Chris Mellors' professional work"
        />
    @endsection

    <!-- Main container -->
    <main class="relative container my-20 mt-64 space-y-6 px-3.5 pt-0 sm:mt-0 sm:space-y-20 sm:pt-40 md:px-24 lg:space-y-12">
        <div class="space-y-6">
            <h1 class="font-merriweather text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100">My portfolio</h1>
            <p class="text-lg leading-7 text-zinc-700 dark:text-zinc-300">
                A selection of client projects I’ve worked on—showcasing design, development, and problem‑solving across different briefs.
                More coming soon.
            </p>
        </div>

        <ul
            class="grid grid-cols-1 gap-x-10 gap-y-10 sm:grid-cols-2 sm:gap-y-12 lg:grid-cols-2 lg:gap-y-14 xl:grid-cols-3 xl:gap-x-12 xl:gap-y-16"
            role="list"
        >
            @foreach (\App\Models\Project::get()->sortDesc() as $project)
                <li
                    class="group relative flex h-full flex-col space-y-5 rounded-2xl bg-white/80 p-6 shadow-sm ring-1 ring-zinc-200/60 transition-transform duration-200 ease-out sm:hover:-translate-y-0.5 sm:hover:shadow-md dark:bg-zinc-800/60 dark:ring-zinc-700/60"
                >
                    <div class="flex flex-1 flex-col space-y-5">
                        <img
                            class="z-10 mx-auto size-16 rounded-full bg-neutral-100 shadow-md ring-1 shadow-zinc-800/5 ring-zinc-900/5 ring-offset-4 transition-transform duration-200 sm:mx-0 sm:group-hover:scale-105 dark:ring-zinc-100/15 dark:ring-offset-zinc-700"
                            src="{{ $project->logo }}"
                            alt="{{ $project->name }}"
                            loading="lazy"
                        />

                        <h2 class="w-full text-center text-base font-semibold text-zinc-800 sm:text-left dark:text-zinc-100">
                            <div
                                class="absolute -inset-x-4 -inset-y-6 z-0 scale-95 rounded-xl bg-zinc-50 opacity-0 shadow-sm transition sm:-inset-x-6 sm:rounded-2xl sm:group-hover:scale-100 sm:group-hover:opacity-100 dark:bg-zinc-900/50"
                            ></div>

                            @if ($project->url)
                                <a href="{{ url($project->url) }}">
                                    <span class="absolute -inset-x-4 -inset-y-6 z-20 sm:-inset-x-6 sm:rounded-2xl"></span>
                                    <span class="relative z-10">{{ $project->name }}</span>
                                </a>
                            @else
                                <span class="relative z-10">{{ $project->name }}</span>
                            @endif
                        </h2>

                        <p class="relative z-10 text-[15px] leading-6 text-zinc-600 dark:text-zinc-400">{!! $project->description !!}</p>

                        @if ($project->testimonial)
                            <blockquote class="relative z-10 text-[15px] leading-6 text-zinc-700 italic dark:text-zinc-300">
                                <span
                                    class="text-pizza dark:text-pizza-dark mr-1 align-[-0.2em]"
                                    aria-hidden="true"
                                >
                                    “
                                </span>
                                {{ $project->testimonial }}
                                <span
                                    class="text-pizza dark:text-pizza-dark ml-1 align-[-0.2em]"
                                    aria-hidden="true"
                                >
                                    ”
                                </span>
                            </blockquote>
                        @endif
                    </div>

                    @if ($project->url)
                        <div class="relative z-10 w-full sm:w-auto">
                            <flux:button
                                class="bg-pizza dark:bg-pizza-dark text-sm"
                                href="{{ url($project->url) }}"
                                variant="primary"
                                target="_blank"
                            >
                                <span>Check out the project</span>
                                <span aria-hidden="true">→</span>
                            </flux:button>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>

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
