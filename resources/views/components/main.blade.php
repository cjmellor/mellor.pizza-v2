@use(App\Actions\FetchTopGithubReposAction)

<main>
    <div class="mt-20 flex flex-col space-y-12 lg:mx-12 lg:flex-row lg:space-y-0 xl:mx-32 2xl:mx-48">
        <div class="mt-44 flex flex-col items-center justify-center gap-y-8 md:mt-0 lg:ml-16 lg:w-1/3 lg:justify-start">
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
                <div
                    class="flex items-center gap-3 rounded-full bg-lime-50/50 px-2 py-1.5 ring-1 ring-lime-400/25 dark:bg-lime-800/50 dark:ring-lime-600/25"
                >
                    <span class="relative flex size-4">
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-lime-400 opacity-75 dark:bg-lime-200"
                        ></span>
                        <span class="relative inline-flex size-4 rounded-full bg-lime-500 dark:bg-lime-300"></span>
                    </span>
                    <p class="font-mono text-lime-800 uppercase md:text-sm dark:text-neutral-100">
                        Available for remote contract or full-time positions
                    </p>
                </div>
                <div class="space-y-8">
                    <p class="leading-8 text-neutral-900 md:text-xl dark:text-neutral-100">
                        <strong class="font-bold">Senior Laravel Developer</strong>
                        specializing in the
                        <strong class="font-bold">TALL stack (Tailwind, Alpine, Laravel, Livewire)</strong>
                        . I deliver
                        <strong class="font-bold">scalable, maintainable, and tested solutions</strong>
                        that help teams ship faster and more reliably.
                    </p>
                    <p class="text-sm text-neutral-900 sm:text-base md:text-lg dark:text-neutral-100">Strong background in:</p>

                    <ul
                        class="mt-2 flex flex-wrap items-center gap-2 md:gap-3"
                        role="list"
                        aria-label="Technologies"
                    >
                        <li>
                            <flux:badge
                                class="transition-transform hover:-translate-y-0.5"
                                color="red"
                                size="lg"
                            >
                                Laravel
                            </flux:badge>
                        </li>
                        <li>
                            <flux:badge
                                class="transition-transform hover:-translate-y-0.5"
                                color="yellow"
                                size="lg"
                            >
                                Livewire
                            </flux:badge>
                        </li>
                        <li>
                            <flux:badge
                                class="transition-transform hover:-translate-y-0.5"
                                color="sky"
                                size="lg"
                            >
                                Tailwind CSS
                            </flux:badge>
                        </li>
                        <li>
                            <flux:badge
                                class="transition-transform hover:-translate-y-0.5"
                                color="green"
                                size="lg"
                            >
                                Vue.js
                            </flux:badge>
                        </li>
                    </ul>

                    <p class="leading-8 md:text-xl">
                        I focus on
                        <strong class="font-bold">clean code, testing, and developer experience</strong>
                        so projects stay solid as they grow.
                    </p>

                    <div>
                        <flux:button
                            href="{{ route('cv') }}"
                            aria-label="View CV"
                            icon="file-text"
                            variant="primary"
                        >
                            View CV
                        </flux:button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--
        <div class="space-y-10 sm:space-y-16">
        <div class="mt-4 text-center font-merriweather text-neutral-600 dark:text-gray-400">
        <p class="inline-flex text-2xl sm:text-4xl">Check out my latest articles
        <a
        href="#blog-posts"
        aria-label="check out latest articles"
        >
        <svg
        class="ml-6 hidden h-10 w-8 animate-bounce text-pizza sm:block dark:text-pizza-dark"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        >
        <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M19 9l-7 7-7-7"
        />
        </svg>
        </a>
        </p>
        </div>
        <hr class="mx-auto w-1/2 border-gray-300 dark:border-gray-700">
        <div id="blog-posts">
        <x-posts-list
        format="short"
        limit="3"
        ></x-posts-list>
        <div class="flex justify-center pb-8 lg:pb-16">
        <x-link
        class="font-merriweather text-xl"
        href="{{ route('blog') }}"
        to="#"
        >See more posts
        </x-link>
        </div>
        </div>
        </div>
    --}}
</main>
