@use(App\Actions\FetchTopGithubReposAction)

<main>
    <div class="mt-18 flex flex-col space-y-12 lg:mx-12 lg:flex-row lg:space-y-0 xl:mx-32 2xl:mx-48">
        <div class="mt-42 flex flex-col items-center justify-center space-y-8 md:mt-0 lg:ml-16 lg:w-1/3 lg:justify-start lg:space-y-6">
            <x-floating-head />

            {{-- X (Twitter) --}}
            <div class="flex space-x-4">
                <flux:button
                    class="group"
                    href="https://x.com/cmellor"
                    aria-label="X"
                    variant="ghost"
                    target="_blank"
                    tooltip="Follow me on X"
                >
                    <svg
                        class="group-hover:text-pizza dark:group-hover:text-pizza-dark size-7 text-gray-900 dark:text-white"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill="currentColor"
                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"
                        />
                    </svg>
                </flux:button>

                {{-- GitHub --}}
                <flux:button
                    class="group"
                    href="https://github.com/cjmellor"
                    aria-label="GitHub"
                    variant="ghost"
                    target="_blank"
                    tooltip="Check out my GitHub"
                >
                    <svg
                        class="group-hover:text-pizza dark:group-hover:text-pizza-dark size-7 text-gray-900 dark:text-white"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill="currentColor"
                            d="M12 0C5.373 0 0 5.373 0 12c0 5.303 3.438 9.8 8.205 11.387.6.111.82-.261.82-.577 0-.285-.01-1.04-.015-2.04-3.338.726-4.042-1.61-4.042-1.61-.546-1.387-1.333-1.757-1.333-1.757-1.09-.745.083-.729.083-.729 1.205.084 1.84 1.237 1.84 1.237 1.07 1.835 2.807 1.305 3.492.998.108-.775.418-1.305.76-1.605-2.665-.305-5.466-1.332-5.466-5.93 0-1.31.468-2.38 1.235-3.22-.123-.303-.535-1.527.117-3.176 0 0 1.008-.322 3.3 1.23a11.53 11.53 0 0 1 3-.405 11.53 11.53 0 0 1 3 .405c2.29-1.552 3.297-1.23 3.297-1.23.653 1.649.241 2.873.118 3.176.77.84 1.235 1.91 1.235 3.22 0 4.61-2.803 5.62-5.475 5.92.43.37.81 1.102.81 2.222 0 1.606-.015 2.898-.015 3.293 0 .319.218.694.825.576C20.565 21.795 24 17.298 24 12c0-6.627-5.373-12-12-12z"
                        />
                    </svg>
                </flux:button>
            </div>

            <flux:separator />

            <h2 class="font-semibold">Most Starred Projects on GitHub</h2>

            <ul class="space-y-2.5 text-sm">
                @foreach (app(FetchTopGithubReposAction::class)->handle() as $repo)
                    <li class="flex items-center gap-x-4">
                        <a
                            class="hover:text-pizza dark:hover:text-pizza-dark flex-1 text-neutral-900 underline hover:underline dark:text-neutral-100"
                            href="{{ $repo['html_url'] }}"
                            target="_blank"
                        >
                            {{ $repo['name'] }}
                        </a>
                        <div class="flex w-20 justify-end">
                            <flux:badge
                                size="sm"
                                variant="pill"
                                inset
                                color="yellow"
                            >
                                <flux:icon.star
                                    class="size-4 text-amber-500"
                                    variant="solid"
                                />
                                <span class="inline-block w-8 text-right">{{ $repo['stargazers_count'] }}</span>
                            </flux:badge>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="lg:ml-24 lg:w-2/3">
            <div
                class="font-merriweather mx-8 flex h-full max-w-prose flex-col justify-center space-y-8 tracking-wider lg:mx-0 lg:text-left"
            >
                <h2 class="text-2xl lg:text-3xl">
                    Hi, I'm
                    <span class="font-extrabold">Chris</span>
                </h2>

                <flux:callout color="lime">
                    <flux:callout.heading>
                        <x-slot name="icon">
                            <span class="relative flex size-4">
                                <span
                                    class="absolute inline-flex h-full w-full animate-ping rounded-full bg-lime-400 opacity-75 dark:bg-lime-200"
                                ></span>
                                <span class="relative inline-flex size-4 rounded-full bg-lime-500 dark:bg-lime-300"></span>
                            </span>
                        </x-slot>
                        Available for remote contract or full-time positions
                    </flux:callout.heading>
                </flux:callout>

                <div class="space-y-10">
                    <p class="leading-8 text-neutral-900 md:text-xl dark:text-neutral-100">
                        <strong>Senior Laravel Developer helping teams ship, scale, and modernise apps.</strong>
                    </p>

                    <p class="text-sm text-neutral-900 sm:text-base md:text-lg dark:text-neutral-100">
                        I focus on writing clean, reliable code — mostly in Laravel and Livewire — and delivering features that are easy to
                        maintain long-term.
                    </p>

                    <div>
                        <flux:button
                            class="bg-pizza dark:bg-pizza-dark hover:bg-orange-500 dark:hover:bg-orange-500"
                            href="{{ route('cv') }}"
                            aria-label="View CV"
                            variant="primary"
                        >
                            Let's work together
                        </flux:button>
                    </div>

                    <flux:avatar.group>
                        <flux:avatar
                            src="https://unavatar.io/tmstor.es"
                            tooltip="Townsend Music"
                        />
                        <flux:avatar
                            src="https://unavatar.io/16personalities.com"
                            tooltip="16 Personalities"
                        />
                        <flux:avatar
                            src="https://unavatar.io/youtube/keisone"
                            tooltip="Keis One: YouTuber"
                        />
                        <flux:avatar :href="route('portfolio')">+</flux:avatar>
                    </flux:avatar.group>

                    @php
                        $technologies = [
                            ['label' => 'Laravel', 'color' => 'red'],
                            ['label' => 'Livewire', 'color' => 'yellow'],
                            ['label' => 'Tailwind CSS', 'color' => 'sky'],
                            ['label' => 'Vue.js', 'color' => 'green'],
                            ['label' => 'CI/CD', 'color' => 'orange'],
                            ['label' => 'API', 'color' => 'purple'],
                        ];
                    @endphp

                    <ul
                        class="mt-2 flex flex-wrap items-center gap-2 md:gap-3"
                        role="list"
                        aria-label="Technologies"
                    >
                        @foreach ($technologies as $technology)
                            <li>
                                <flux:badge
                                    class="transition-transform hover:scale-105"
                                    color="{{ $technology['color'] }}"
                                    size="lg"
                                >
                                    {{ $technology['label'] }}
                                </flux:badge>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
