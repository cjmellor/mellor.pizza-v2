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
    <main class="relative container my-20 space-y-8 px-3.5 pt-40 sm:pt-0 md:px-24">
        <h1 class="font-merriweather text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100">My portfolio</h1>
        <p class="mt-6 text-base text-zinc-600 dark:text-zinc-400">Below is the private client work I have done. I am new to this so it is a little bare at the moment.</p>
        <ul
            role="list"
            class="mt-16 grid grid-cols-1 gap-x-12 gap-y-16 sm:mt-20 sm:grid-cols-2 lg:grid-cols-3"
        >
            @foreach (\App\Models\Project::get() as $project)
                <li class="group relative flex flex-col items-start">
                    <img
                        alt="{{ $project->name }}"
                        loading="lazy"
                        class="z-10 size-16 rounded-full shadow-md ring-1 shadow-zinc-800/5 ring-zinc-900/5 ring-offset-4 dark:ring-zinc-100/15 dark:ring-offset-zinc-700"
                        src="{{ asset('storage/portfolio_logos/' . $project->logo) }}"
                    />

                    <h2 class="mt-6 text-base font-semibold text-zinc-800 dark:text-zinc-100">
                        <div class="absolute -inset-x-4 -inset-y-6 z-0 scale-95 bg-zinc-50 opacity-0 transition group-hover:scale-100 group-hover:opacity-100 sm:-inset-x-6 sm:rounded-2xl dark:bg-zinc-900/50"></div>
                        <a href="https://{{ $project->url }}">
                            <span class="absolute -inset-x-4 -inset-y-6 z-20 sm:-inset-x-6 sm:rounded-2xl"></span>
                            <span class="relative z-10">{{ $project->name }}</span>
                        </a>
                    </h2>

                    <p class="relative z-10 mt-2 text-sm text-zinc-600 dark:text-zinc-400">{!! $project->description !!}</p>

                    @if ($project->testimonial)
                        <p class="relative z-10 mt-4 text-sm text-zinc-600 italic dark:text-zinc-400">
                            <span class="text-pizza dark:text-pizza-dark">"</span>
                            {{ $project->testimonial }}
                            <span class="text-pizza dark:text-pizza-dark">"</span>
                        </p>
                    @endif

                    <p class="group-hover:text-pizza dark:group-hover:text-pizza-dark relative z-10 mt-6 flex text-sm font-medium text-zinc-400 transition dark:text-zinc-300">
                        <a
                            href="https://{{ $project->url }}"
                            target="_blank"
                            class="flex items-center"
                        >
                            <span>View project &RightArrow;</span>
                        </a>
                    </p>
                </li>
            @endforeach
        </ul>
    </main>
</x-layout.main>
