<x-layout.main
    container
    subTitle="Chris Mellors' CV"
>
    <x-header />

    @section('meta-description')
        <meta
            name="description"
            content="Discover Chris Mellors' professional experience and skills"
        />
    @endsection

    <!-- Main container -->
    <main
        class="relative container my-20 space-y-8 px-3.5 pt-40 sm:pt-0 md:px-24 print:my-8 print:space-y-4 print:px-4 print:text-sm print:leading-tight"
    >
        {{-- Print button --}}
        <div class="hidden xl:absolute xl:top-0 xl:right-0 xl:block print:hidden">
            <flux:button
                variant="primary"
                color="orange"
                onclick="window.print()"
                icon="printer"
            >
                Print
            </flux:button>
        </div>
        <!-- Header section -->
        <header class="mb-12 text-center print:mb-6">
            <h1 class="mb-2 hidden text-4xl font-bold print:block">Chris Mellor</h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 print:text-sm print:leading-tight print:text-black">
                A
                <strong class="font-semibold">Laravel / Full-stack Developer</strong>
                from
                <strong class="font-semibold">Leeds, UK</strong>
            </p>

            <!-- Contact links -->
            <div class="mt-6 flex flex-wrap justify-center gap-4 text-lg md:text-base print:gap-2 print:text-xs">
                {{-- Email --}}
                <a
                    class="text-pizza dark:text-pizza-dark flex items-center gap-2 hover:underline hover:opacity-80 print:text-black"
                    href="mailto:chris@mellor.pizza"
                >
                    <svg
                        class="h-5 w-5 fill-none"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <rect
                            width="20"
                            height="16"
                            x="2"
                            y="4"
                            rx="2"
                        />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                    </svg>
                    <span class="print:hidden">Email</span>
                    <span class="hidden print:inline">chris@mellor.pizza</span>
                </a>

                {{-- GitHub --}}
                <a
                    class="text-pizza dark:text-pizza-dark flex items-center gap-2 hover:underline hover:opacity-80 print:text-black"
                    href="https://github.com/cjmellor"
                >
                    <svg
                        class="h-5 w-5 fill-none"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path
                            d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"
                        />
                        <path d="M9 18c-4.51 2-5-2-7-2" />
                    </svg>
                    <span class="print:hidden">GitHub</span>
                    <span class="hidden print:inline">cjmellor</span>
                </a>

                {{-- X --}}
                <a
                    class="text-pizza dark:text-pizza-dark flex items-center gap-2 hover:opacity-80 print:text-black"
                    href="https://x.com/cmellor"
                >
                    <svg
                        class="h-5 w-5 fill-none"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M4 4l11.733 16h4.267l-11.733-16zM4 20l6.768-8.309m2.197-2.691l6.768-8.309" />
                    </svg>
                    <span class="hidden print:inline">@cmellor</span>
                </a>
            </div>
        </header>

        <!-- Professional Summary -->
        <section>
            <h2 class="text-pizza dark:text-pizza-dark mb-4 text-2xl font-bold print:mb-2 print:text-lg print:text-black">
                Professional Summary
            </h2>
            <p
                class="text-sm leading-relaxed text-gray-700 md:text-base dark:text-gray-300 print:text-sm print:leading-tight print:text-black"
            >
                I’m a full-stack developer with six years’ experience building SaaS platforms and internal tools. Most of my work has been
                in the Laravel ecosystem, but I’m quick to pick up whatever stack a project calls for. I care about writing clean, testable
                code and focus on building solutions that are both practical and maintainable.
                <br />
                <br />
                I keep up with new tech, not just in PHP and Laravel but across the wider software world—especially around AI, which I’ve
                been exploring as a way to improve workflows and code quality. I also enjoy working on side projects to try out new ideas,
                experiment with tools, and keep learning.
            </p>
        </section>

        <!-- Technical Skills -->
        <section>
            <h2 class="text-pizza dark:text-pizza-dark mb-4 text-2xl font-bold print:mb-2 print:text-lg print:text-black">
                Technical Skills
            </h2>

            <div class="print:hidden">
                <div class="grid gap-6 md:grid-cols-3 print:grid-cols-1">
                    <!-- Primary Stack -->
                    <div
                        class="bg-pizza/5 shadow-pizza/50 ring-pizza/20 dark:bg-dark dark:ring-dark-line rounded-lg p-6 ring-1 print:bg-transparent print:p-0 print:px-4 print:shadow-none print:ring-0"
                    >
                        <h3 class="text-pizza dark:text-pizza-dark mb-3 font-bold print:text-black">Primary Stack</h3>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                            <li>Laravel</li>
                            <li>Vue.js</li>
                            <li>Livewire</li>
                            <li>Tailwind CSS</li>
                        </ul>
                    </div>

                    <!-- Additional Technologies -->
                    <div
                        class="bg-pizza/5 shadow-pizza/50 ring-pizza/20 dark:bg-dark dark:ring-dark-line rounded-lg p-6 ring-1 print:bg-transparent print:p-0 print:px-4 print:shadow-none print:ring-0"
                    >
                        <h3 class="text-pizza dark:text-pizza-dark mb-3 font-bold print:text-black">Additional Technologies</h3>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                            <li>Alpine.js</li>
                            <li>Inertia.js</li>
                            <li>PestPHP / PHPUnit</li>
                            <li>Git</li>
                            <li>GitHub</li>
                            <li>CI / CD</li>
                        </ul>
                    </div>

                    <!-- Development Environment -->
                    <div
                        class="bg-pizza/5 shadow-pizza/50 ring-pizza/20 dark:bg-dark dark:ring-dark-line rounded-lg p-6 ring-1 print:bg-transparent print:p-0 print:px-4 print:shadow-none print:ring-0"
                    >
                        <h3 class="text-pizza dark:text-pizza-dark mb-3 font-bold print:text-black">Development Environment</h3>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                            <li>PhpStorm for daily development</li>
                            <li>AI tools for productivity and faster coding workflows</li>
                            <li>Docker (and Laravel Sail) when required</li>
                            <li>Experience managing Laravel Vapor environments</li>
                        </ul>
                    </div>
                </div>
            </div>

            <ul class="hidden space-y-1 text-black print:block print:list-disc print:pl-6 print:text-sm print:leading-tight">
                <li>
                    <strong>Primary Stack:</strong>
                    Laravel, Vue.js, Livewire, Tailwind CSS
                </li>
                <li>
                    <strong>Additional Technologies:</strong>
                    Alpine.js, Inertia.js, PestPHP / PHPUnit, Git, GitHub, CI / CD
                </li>
                <li>
                    <strong>Development Environment:</strong>
                    PhpStorm for daily development; AI tools for productivity and faster coding workflows; Docker (and Laravel Sail) when
                    required; Experience managing Laravel Vapor environments
                </li>
            </ul>
        </section>

        <!-- Professional Experience -->
        <section class="space-y-8 sm:space-y-0 print:space-y-4">
            <h2 class="text-pizza dark:text-pizza-dark text-2xl font-bold print:mb-2 print:text-lg print:text-black">
                Professional Experience
            </h2>

            {{-- Contract work --}}
            <div class="dark:bg-dark rounded-lg bg-white md:p-6 print:md:p-2">
                <div class="mb-4 flex flex-wrap items-start justify-between">
                    <div class="space-y-1.5">
                        <h3
                            class="text-pizza dark:text-pizza-dark text-xl font-bold print:mb-1 print:text-base print:font-semibold print:text-black"
                        >
                            Freelance
                        </h3>
                    </div>
                    <p class="dark:text-gray-400 print:text-black">02/2025 - Present</p>
                </div>
                <ul
                    class="list-inside list-disc space-y-2 text-sm text-gray-700 md:text-base dark:text-gray-300 print:space-y-1 print:text-xs print:leading-snug print:text-black"
                >
                    <li>
                        Completed freelance contracts focused on Laravel and the TALL stack, contributing to maintenance, feature builds,
                        and front-end improvements while quickly adapting to different codebases and delivering results.
                    </li>
                </ul>
            </div>

            {{-- Townsend Music --}}
            <div class="dark:bg-dark rounded-lg bg-white md:p-6 print:md:p-2">
                <div class="mb-4 flex flex-wrap items-start justify-between">
                    <div class="space-y-1.5">
                        <h3
                            class="text-pizza dark:text-pizza-dark text-xl font-bold print:mb-1 print:text-base print:font-semibold print:text-black"
                        >
                            Senior Laravel Developer
                        </h3>
                        <p class="font-semibold text-gray-600 dark:text-gray-400 print:text-sm print:text-black">Townsend Music</p>
                    </div>
                    <p class="dark:text-gray-400 print:text-black">08/2025 - Present</p>
                </div>
                <ul
                    class="list-inside list-disc space-y-2 text-sm text-gray-700 md:text-base dark:text-gray-300 print:space-y-1 print:text-xs print:leading-snug print:text-black"
                >
                    <li>
                        Implemented new website designs from Figma into the company’s Filament-based platform, integrating templates with
                        dynamic data
                    </li>
                    <li>
                        Maintained and extended core systems built on the Filament framework, resolving bugs reported through Sentry and
                        ClickUp
                    </li>
                    <li>
                        Participated in a rotating support schedule, acting as first point of contact for internal teams and prioritising
                        issues by severity
                    </li>
                    <li>
                        Monitored and resolved failed jobs and service outages, responding to automated alerts via Slack to minimise
                        downtime
                    </li>
                    <li>
                        Created and updated technical documentation for new features and fixes to support knowledge sharing across the team
                    </li>
                </ul>
            </div>

            <!-- 59club Ltd -->
            <div class="dark:bg-dark rounded-lg bg-white md:p-6 print:md:p-2">
                <div class="mb-4 flex flex-wrap items-start justify-between">
                    <div class="space-y-1.5">
                        <h3
                            class="text-pizza dark:text-pizza-dark text-xl font-bold print:mb-1 print:text-base print:font-semibold print:text-black"
                        >
                            Laravel Developer
                        </h3>
                        <p class="font-semibold text-gray-600 dark:text-gray-400 print:text-sm print:text-black">59club Ltd</p>
                    </div>
                    <p class="dark:text-gray-400 print:text-black">01/2022 - 11/2024</p>
                </div>
                <ul
                    class="list-inside list-disc space-y-2 text-sm text-gray-700 md:text-base dark:text-gray-300 print:space-y-1 print:text-xs print:leading-snug print:text-black"
                >
                    <li>Spearheaded system modernisation by resolving critical bugs and implementing new features</li>
                    <li>
                        Core member of a three-person team rebuilding the company's flagship software from the ground up using the TALL
                        stack (Tailwind, Alpine.js, Laravel, Livewire)
                    </li>
                    <li>
                        Successfully delivered a complete mobile solution, encompassing both a cross-platform application (built with Vue.js
                        and Ionic Framework) and its supporting Laravel API using Sanctum authentication. Notable achievement in
                        independently learning multiple new technologies and delivering both applications to production within a 6-month
                        timeline
                    </li>
                    <li>
                        Established and configured Laravel Vapor infrastructure, including implementation of dynamic PR environments for
                        enhanced testing capabilities
                    </li>
                    <li>Developed and maintained robust CI/CD pipelines in Bitbucket to ensure smooth deployment processes</li>
                </ul>
            </div>

            <!-- Jump24 Ltd -->
            <div class="dark:bg-dark rounded-lg bg-white md:p-6 print:md:p-2">
                <div class="mb-4 flex flex-wrap items-start justify-between">
                    <div class="space-y-1.5">
                        <h3
                            class="text-pizza dark:text-pizza-dark text-xl font-bold print:mb-1 print:text-base print:font-semibold print:text-black"
                        >
                            PHP Developer
                        </h3>
                        <p class="font-semibold text-gray-600 dark:text-gray-400 print:text-sm print:text-black">Jump Twenty Four Ltd</p>
                    </div>
                    <p class="dark:text-gray-400 print:text-black">06/2021 - 12/2021</p>
                </div>
                <ul
                    class="list-inside list-disc space-y-2 text-sm text-gray-700 md:text-base dark:text-gray-300 print:space-y-1 print:text-xs print:leading-snug print:text-black"
                >
                    <li>
                        Led multiple client projects in an agency environment, focusing on modernising legacy applications using Laravel and
                        modern PHP practices
                    </li>
                    <li>
                        Architected and implemented new features using Inertia.js, demonstrating ability to adapt to client-specific
                        technology requirements
                    </li>
                    <li>
                        Collaborated directly with clients through daily stand-ups to gather requirements and demonstrate feature
                        implementations
                    </li>
                    <li>Established coding standards and best practices that were adopted across multiple projects</li>
                </ul>
            </div>

            <!-- Interior Goods Direct -->
            <div class="dark:bg-dark rounded-lg bg-white md:p-6 print:md:p-2">
                <div class="mb-4 flex flex-wrap items-start justify-between">
                    <div class="space-y-1.5">
                        <h3
                            class="text-pizza dark:text-pizza-dark text-xl font-bold print:mb-1 print:text-base print:font-semibold print:text-black"
                        >
                            Full-stack Developer
                        </h3>
                        <p class="font-semibold text-gray-600 dark:text-gray-400 print:text-sm print:text-black">Interior Goods Direct</p>
                    </div>
                    <p class="dark:text-gray-400 print:text-black">01/2021 - 06/2021</p>
                </div>
                <ul
                    class="list-inside list-disc space-y-2 text-sm text-gray-700 md:text-base dark:text-gray-300 print:space-y-1 print:text-xs print:leading-snug print:text-black"
                >
                    <li>
                        Played a key role in developing and enhancing a Laravel-based eCommerce platform for a major UK blinds and curtains
                        retailer
                    </li>
                    <li>Built complex product customisation features using Vue.js components integrated with Laravel backend</li>
                    <li>Implemented responsive admin interfaces using Bootstrap, improving internal team efficiency</li>
                    <li>Optimised database queries and API endpoints to improve application performance</li>
                </ul>
            </div>

            <!-- VOODOO -->
            <div class="dark:bg-dark rounded-lg bg-white md:p-6 print:md:p-2">
                <div class="mb-4 flex flex-wrap items-start justify-between">
                    <div class="space-y-1.5">
                        <h3
                            class="text-pizza dark:text-pizza-dark text-xl font-bold print:mb-1 print:text-base print:font-semibold print:text-black"
                        >
                            Full-stack Developer
                        </h3>
                        <p class="font-semibold text-gray-600 dark:text-gray-400 print:text-sm print:text-black">VOODOO</p>
                    </div>
                    <p class="dark:text-gray-400 print:text-black">11/2019 - 11/2020</p>
                </div>
                <ul
                    class="list-inside list-disc space-y-2 text-sm text-gray-700 md:text-base dark:text-gray-300 print:space-y-1 print:text-xs print:leading-snug print:text-black"
                >
                    <li>
                        Spearheaded complete rebuild of company website using Laravel, Vue.js, and Tailwind CSS, delivering a modern,
                        responsive platform
                    </li>
                    <li>Designed and implemented scalable architecture using Docker containerisation and Kubernetes orchestration</li>
                    <li>Established automated deployment workflows through custom CI/CD pipeline configurations</li>
                    <li>Improved development workflow by implementing containerised environments using Rancher</li>
                </ul>
            </div>
        </section>

        <!-- Industry Engagement & Open Source -->
        <section>
            <h2 class="text-pizza dark:text-pizza-dark mb-4 text-2xl font-bold print:mb-2 print:text-lg print:text-black">
                Laravel Community & Open Source
            </h2>
            <div class="dark:bg-dark rounded-lg bg-white">
                <p
                    class="text-sm leading-relaxed text-gray-700 md:text-base dark:text-gray-300 print:text-sm print:leading-tight print:text-black"
                >
                    I actively contribute to the Laravel ecosystem by creating and maintaining open source packages, with my projects
                    collectively receiving over 1,000 stars on GitHub. Some of these packages have been highlighted on social media and even
                    reviewed on YouTube, helping them reach a wider audience. I take pride in maintaining my work to high standards,
                    preferring to build and support my own solutions (or forks) rather than rely on unmaintained packages. Alongside
                    publishing code, I stay engaged with the Laravel community through newsletters, Laracasts, and online discussion,
                    keeping up with new features and tools. I also experiment with AI-assisted development in my side projects to explore
                    new workflows and improve productivity.
                </p>
            </div>
        </section>

        <!-- Interests -->
        <section>
            <h2 class="text-pizza dark:text-pizza-dark mb-4 text-2xl font-bold print:mb-2 print:text-lg print:text-black">Interests</h2>
            <div class="dark:bg-dark rounded-lg bg-white">
                <p
                    class="text-sm leading-relaxed text-gray-700 md:text-base dark:text-gray-300 print:text-sm print:leading-tight print:text-black"
                >
                    Outside of work, I love travel—often solo, sometimes with my partner—and I’m the sort who plans trips after falling down
                    a YouTube travel‑vlog rabbit hole. I’m into live music and the occasional festival when a favourite band is touring. I
                    also tinker with tech and use AI day‑to‑day (for learning, planning, and general life admin), more out of curiosity than
                    hype.
                </p>
            </div>
        </section>
    </main>
</x-layout.main>
