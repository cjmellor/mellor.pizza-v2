@php
    $projects = \App\Portfolio\Project::all();
    $pbr = $projects->firstWhere('name', 'PoweredByRental');
    $appHive = $projects->firstWhere('name', 'App-Hive');
@endphp

<main class="font-merriweather">
    <section class="mt-12 flex flex-col space-y-12 lg:mx-12 lg:mt-18 lg:flex-row lg:space-y-0 xl:mx-32 2xl:mx-48">
        <div class="flex flex-col items-center justify-center space-y-8 lg:ml-16 lg:w-1/3 lg:justify-start lg:space-y-6">
            <x-floating-head />

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
        </div>

        <div class="lg:ml-24 lg:w-2/3">
            <div class="mx-8 flex h-full max-w-prose flex-col justify-center space-y-8 tracking-wide lg:mx-0">
                <h1 class="text-3xl leading-tight font-extrabold text-neutral-900 lg:text-4xl dark:text-neutral-100">
                    Laravel &amp; PHP contractor.
                    <span class="text-pizza dark:text-pizza-dark">Remote, worldwide.</span>
                </h1>

                <p class="leading-8 text-neutral-900 md:text-xl dark:text-neutral-100">
                    AI writes a lot of my code. I review all of it before it lands, security included, because I don't take it on trust.
                </p>

                <div class="flex flex-wrap items-center gap-4">
                    <flux:button
                        class="bg-pizza dark:bg-pizza-dark hover:bg-orange-500 dark:hover:bg-pink-700"
                        variant="primary"
                        x-data
                        x-on:click.prevent="$dispatch('show-contact')"
                    >
                        Let's work together
                    </flux:button>

                    <span class="flex items-center gap-2 text-sm text-neutral-700 dark:text-neutral-300">
                        <span class="size-2.5 rounded-full bg-lime-500 dark:bg-lime-300"></span>
                        Available now
                    </span>
                </div>
            </div>
        </div>
    </section>

    <div class="mx-8 mt-24 space-y-24 lg:mx-28 xl:mx-48 2xl:mx-64">
        <section class="space-y-8">
            <h2 class="text-2xl font-bold text-neutral-900 lg:text-3xl dark:text-neutral-100">What I do</h2>

            <div class="grid gap-6 lg:grid-cols-2">
                <flux:card
                    class="h-full"
                    body="inset"
                    variant="muted"
                >
                    <flux:card.header>
                        <flux:card.heading level="3">Laravel &amp; PHP contracting</flux:card.heading>
                    </flux:card.header>
                    <flux:card.body>
                        <flux:text>
                            I join your team remotely and own the work end to end: features, fixes, integrations and releases. Spec first,
                            then the build, then a code and security review before anything merges.
                        </flux:text>
                    </flux:card.body>
                </flux:card>

                <flux:card
                    class="h-full"
                    body="inset"
                    variant="muted"
                >
                    <flux:card.header class="flex flex-wrap items-center justify-between gap-x-3 gap-y-1">
                        <flux:card.heading
                            class="whitespace-nowrap"
                            level="3"
                        >
                            Rescue &amp; hardening
                        </flux:card.heading>
                        <flux:card.actions>
                            <flux:button
                                href="{{ route('app-security-review') }}"
                                size="sm"
                                variant="ghost"
                                icon:trailing="arrow-right"
                                wire:navigate.hover
                            >
                                See the security review
                            </flux:button>
                        </flux:card.actions>
                    </flux:card.header>
                    <flux:card.body>
                        <flux:text>
                            Your app was built fast, by a team in a hurry or with Lovable, Supabase or an AI agent, and now real users are
                            on it. I find what's exposed or slow, fix it, and get it hosted, backed up and patched properly.
                        </flux:text>
                    </flux:card.body>
                </flux:card>
            </div>

            <p class="text-neutral-700 dark:text-neutral-300">Laravel and PHP first. Other stacks when the job needs it.</p>
        </section>

        <section class="space-y-8">
            <h2 class="text-2xl font-bold text-neutral-900 lg:text-3xl dark:text-neutral-100">Recent work</h2>

            <div class="grid gap-6 lg:grid-cols-2">
                <flux:card
                    class="flex flex-col"
                    body="inset"
                    variant="muted"
                >
                    <flux:card.header class="flex items-center gap-3">
                        <flux:avatar
                            src="{{ $pbr->logo }}"
                            alt="{{ $pbr->name }}"
                            size="sm"
                            circle
                        />
                        <div class="min-w-0 flex-1">
                            <flux:card.heading level="3">PoweredByRental</flux:card.heading>
                            <flux:card.subheading>{{ $pbr->url }}</flux:card.subheading>
                        </div>
                        <flux:card.actions>
                            <flux:button
                                href="https://{{ $pbr->url }}"
                                aria-label="Visit PoweredByRental"
                                size="sm"
                                variant="ghost"
                                icon="arrow-up-right"
                                target="_blank"
                            />
                        </flux:card.actions>
                    </flux:card.header>
                    <flux:card.body class="flex-1">
                        <flux:text>
                            Full-stack contract work on a multi-tenant SaaS platform for equipment hire companies, built on PHP 8, SQL
                            Server and Vue 3.
                        </flux:text>
                    </flux:card.body>
                </flux:card>

                <flux:card
                    class="flex flex-col"
                    body="inset"
                    variant="muted"
                >
                    <flux:card.header class="flex items-center gap-3">
                        <flux:avatar
                            src="{{ $appHive->logo }}"
                            alt="{{ $appHive->name }}"
                            size="sm"
                            circle
                        />
                        <div class="min-w-0 flex-1">
                            <flux:card.heading level="3">App-Hive</flux:card.heading>
                            <flux:card.subheading>Shopify app, Laravel and Livewire</flux:card.subheading>
                        </div>
                        <flux:card.actions>
                            <flux:button
                                href="https://{{ $appHive->url }}"
                                aria-label="Visit App-Hive"
                                size="sm"
                                variant="ghost"
                                icon="arrow-up-right"
                                target="_blank"
                            />
                        </flux:card.actions>
                    </flux:card.header>
                    <flux:card.body class="flex-1">
                        <flux:text>
                            I built features and fixes alongside Philo, working from his issues and shipping each change through his review.
                        </flux:text>
                    </flux:card.body>
                    <flux:card.footer>
                        <figure class="space-y-2">
                            <blockquote>
                                <flux:text class="italic">“{{ $appHive->testimonial }}”</flux:text>
                            </blockquote>
                            <figcaption>
                                <flux:text size="sm">Philo, App-Hive</flux:text>
                            </figcaption>
                        </figure>
                    </flux:card.footer>
                </flux:card>
            </div>

            <flux:link
                href="{{ route('portfolio') }}"
                wire:navigate.hover
            >
                More in my portfolio
            </flux:link>
        </section>

        <section class="space-y-6">
            <h2 class="text-2xl font-bold text-neutral-900 lg:text-3xl dark:text-neutral-100">Working with me</h2>

            <flux:card
                body="inset"
                variant="muted"
            >
                <flux:card.body>
                    <ul class="list-outside list-disc space-y-3 pl-5 leading-7 text-neutral-700 dark:text-neutral-300">
                        <li>I reply the same day and keep you updated as the work moves.</li>
                        <li>I review everything before it lands, whether I wrote it or an AI agent did.</li>
                        <li>Once the work's paid for, everything's handed over: code, repo, keys and accounts.</li>
                    </ul>
                </flux:card.body>
            </flux:card>
        </section>

        <flux:card
            body="inset"
            variant="muted"
        >
            <flux:card.body class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <p class="text-neutral-800 dark:text-neutral-200">
                    Built something fast and not sure it's safe?
                    <span class="text-neutral-600 dark:text-neutral-400">There's a fixed-price security review.</span>
                </p>
                <flux:button
                    class="shrink-0"
                    href="{{ route('app-security-review') }}"
                    wire:navigate.hover
                >
                    See what's checked
                </flux:button>
            </flux:card.body>
        </flux:card>

        <flux:card
            class="text-center"
            body="inset"
            variant="muted"
        >
            <flux:card.header>
                <flux:card.heading
                    size="lg"
                    level="2"
                >
                    Tell me what you're building
                </flux:card.heading>
                <flux:card.subheading>Available now · I reply the same day</flux:card.subheading>
            </flux:card.header>
            <flux:card.body class="flex flex-wrap items-center justify-center gap-4">
                <flux:button
                    class="bg-pizza dark:bg-pizza-dark hover:bg-orange-500 dark:hover:bg-pink-700"
                    variant="primary"
                    x-data
                    x-on:click.prevent="$dispatch('show-contact')"
                >
                    Get in touch
                </flux:button>
                <flux:button
                    href="mailto:chris@mellor.pizza"
                    variant="ghost"
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
            </flux:card.body>
        </flux:card>
    </div>
</main>
