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
        class="relative container my-20 mt-6 space-y-8 px-3.5 pt-0 sm:mt-0 sm:pt-40 md:px-24 print:my-8 print:space-y-4 print:px-4 print:pt-0 print:text-sm print:leading-tight"
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
                <strong class="font-semibold">AI-First Full-Stack Engineer</strong>
                · UK-based, remote
            </p>
            <p
                class="mt-1 text-base text-gray-500 md:text-sm dark:text-gray-400 print:text-xs print:leading-tight print:text-black"
            >
                I build and ship production software with Claude Code, mostly on Laravel.
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
                I've been building software commercially for over six years, with the better part of a decade in tech before I moved into
                development proper.
                <br />
                <br />
                The way I build software has changed. These days I write less of it line by line and spend more time directing the work: I
                plan it properly first, get the spec and the edge cases sorted before anything gets built, then let AI agents handle the
                implementation. It means I ship more, and ship it faster, but the standards haven't slipped: the decisions and the review are
                still mine.
                <br />
                <br />
                I'm not just guessing and hoping something works. I know Laravel well, I'm more than comfortable on the front-end, and I've
                got enough range across everything else to stay in control of the code rather than just accepting it—and I review everything
                the AI writes, security included, because I don't take it on trust. Laravel is still my main framework, and this is
                just genuinely how I work now.
            </p>
        </section>

        <!-- How I Work -->
        <section>
            <h2 class="text-pizza dark:text-pizza-dark mb-4 text-2xl font-bold print:mb-2 print:text-lg print:text-black">
                How I Work
            </h2>
            <div
                class="bg-pizza/5 ring-pizza/20 dark:bg-dark dark:ring-dark-line rounded-lg p-6 ring-1 print:bg-transparent print:p-0 print:px-4 print:shadow-none print:ring-0"
            >
                <p
                    class="mb-4 text-sm leading-relaxed text-gray-700 md:text-base dark:text-gray-300 print:mb-2 print:text-sm print:leading-tight print:text-black"
                >
                    I've settled into a way of working that does most of the thinking up front, before any code exists. By the time I start
                    building, the hard decisions are already made, so it lands clean and rarely needs much reworking:
                </p>
                <ol
                    class="mb-4 flex flex-nowrap items-center justify-center gap-x-1.5 whitespace-nowrap font-mono text-[0.6rem] font-medium text-gray-800 sm:gap-x-2 sm:text-xs md:gap-x-3 md:text-sm dark:text-gray-200 print:mb-2 print:flex-wrap print:justify-start print:gap-x-2 print:text-xs print:text-black"
                >
                    <li class="shrink-0">Map the problem</li>
                    <li class="text-pizza dark:text-pizza-dark shrink-0" aria-hidden="true">→</li>
                    <li class="shrink-0">Write the spec</li>
                    <li class="text-pizza dark:text-pizza-dark shrink-0" aria-hidden="true">→</li>
                    <li class="shrink-0">Break it into tickets</li>
                    <li class="text-pizza dark:text-pizza-dark shrink-0" aria-hidden="true">→</li>
                    <li class="shrink-0">Implement with AI agents</li>
                    <li class="text-pizza dark:text-pizza-dark shrink-0" aria-hidden="true">→</li>
                    <li class="shrink-0">Code &amp; security review</li>
                </ol>
                <p
                    class="text-sm leading-relaxed text-gray-700 md:text-base dark:text-gray-300 print:text-sm print:leading-tight print:text-black"
                >
                    Claude Code is what I use day to day, with Anthropic's models doing the work. I keep an eye on the other models and tools
                    out there, but this setup has worked so well I've had no reason to move off it. And when I catch myself doing the same
                    thing more than once, I'll turn it into a reusable skill so I never have to work it out from scratch again.
                </p>
            </div>
        </section>

        <!-- Technical Skills -->
        <section>
            <h2 class="text-pizza dark:text-pizza-dark mb-4 text-2xl font-bold print:mb-2 print:text-lg print:text-black">
                Technical Skills
            </h2>

            <div class="print:hidden">
                <div class="grid gap-6 md:grid-cols-3 print:grid-cols-1">
                    <!-- AI Engineering & Workflow -->
                    <div
                        class="bg-pizza/5 shadow-pizza/50 ring-pizza/20 dark:bg-dark dark:ring-dark-line rounded-lg p-6 ring-1 print:bg-transparent print:p-0 print:px-4 print:shadow-none print:ring-0"
                    >
                        <h3 class="text-pizza dark:text-pizza-dark mb-3 font-bold print:text-black">AI Engineering &amp; Workflow</h3>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                            <li>Claude Code (primary harness)</li>
                            <li>Anthropic (Claude) models</li>
                            <li>Spec-driven agent workflows</li>
                            <li>AI-assisted code &amp; security review</li>
                            <li>Comfortable across other models &amp; harnesses</li>
                        </ul>
                    </div>

                    <!-- Core Stack -->
                    <div
                        class="bg-pizza/5 shadow-pizza/50 ring-pizza/20 dark:bg-dark dark:ring-dark-line rounded-lg p-6 ring-1 print:bg-transparent print:p-0 print:px-4 print:shadow-none print:ring-0"
                    >
                        <h3 class="text-pizza dark:text-pizza-dark mb-3 font-bold print:text-black">Core Stack</h3>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                            <li>Laravel / PHP</li>
                            <li>Livewire</li>
                            <li>Vue.js &amp; Inertia.js</li>
                            <li>Alpine.js</li>
                            <li>Tailwind CSS</li>
                        </ul>
                    </div>

                    <!-- Platform & Practices -->
                    <div
                        class="bg-pizza/5 shadow-pizza/50 ring-pizza/20 dark:bg-dark dark:ring-dark-line rounded-lg p-6 ring-1 print:bg-transparent print:p-0 print:px-4 print:shadow-none print:ring-0"
                    >
                        <h3 class="text-pizza dark:text-pizza-dark mb-3 font-bold print:text-black">Platform &amp; Practices</h3>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                            <li>Pest / PHPUnit</li>
                            <li>CI / CD</li>
                            <li>Docker</li>
                            <li>Linux &amp; web infrastructure</li>
                        </ul>
                    </div>
                </div>
            </div>

            <ul class="hidden space-y-1 text-black print:block print:list-disc print:pl-6 print:text-sm print:leading-tight">
                <li>
                    <strong>AI Engineering &amp; Workflow:</strong>
                    Claude Code (primary harness), Anthropic (Claude) models, spec-driven agent workflows, AI-assisted code &amp; security
                    review; comfortable across other models &amp; harnesses
                </li>
                <li>
                    <strong>Core Stack:</strong>
                    Laravel / PHP, Livewire, Vue.js &amp; Inertia.js, Alpine.js, Tailwind CSS
                </li>
                <li>
                    <strong>Platform &amp; Practices:</strong>
                    Pest / PHPUnit, CI / CD, Docker, Linux &amp; web infrastructure
                </li>
            </ul>
        </section>

        <!-- Professional Experience -->
        <section class="space-y-8 sm:space-y-0 print:space-y-4">
            <h2 class="text-pizza dark:text-pizza-dark text-2xl font-bold print:mb-2 print:text-lg print:text-black">
                Professional Experience
            </h2>

            {{-- Right Global Group (primary / latest) --}}
            <div
                class="border-pizza/40 dark:border-pizza-dark/40 dark:bg-dark rounded-lg border-l-4 bg-white pl-4 md:p-6 print:border-l-2 print:md:p-2 print:pl-2"
            >
                <div class="mb-4 flex flex-wrap items-start justify-between">
                    <div class="space-y-1.5">
                        <h3
                            class="text-pizza dark:text-pizza-dark text-xl font-bold print:mb-1 print:text-base print:font-semibold print:text-black"
                        >
                            Software Engineer
                        </h3>
                        <p class="font-semibold text-gray-600 dark:text-gray-400 print:text-sm print:text-black">Right Global Group</p>
                    </div>
                    <p class="dark:text-gray-400 print:text-black">04/2026 - Present</p>
                </div>
                <p class="mb-3 text-sm text-gray-600 md:text-base dark:text-gray-400 print:mb-2 print:text-xs print:text-black">
                    Full-stack engineer on a multi-tenant, real-money prize-competitions platform (Laravel, Inertia, Vue 3, MariaDB /
                    PostgreSQL, Redis / Horizon) running roughly 30 production tenant sites. Everything below was built with my AI-first,
                    spec-driven workflow.
                </p>
                <ul
                    class="list-inside list-disc space-y-2 text-sm text-gray-700 md:text-base dark:text-gray-300 print:space-y-1 print:text-xs print:leading-snug print:text-black"
                >
                    <li>
                        Designed and built an in-house SMS marketing platform end-to-end in four weeks—letting tenants message their customers
                        with merge tags for live data, reusable recipient lists, a rules-based automation engine (e.g. an SMS triggered when a
                        new customer registers and makes a purchase), and campaign analytics
                    </li>
                    <li>
                        Laid the groundwork for the company's move to a self-service SaaS on Laravel Cloud, standing up automated per-tenant app
                        provisioning and porting the platform from MariaDB to PostgreSQL where Cloud required it
                    </li>
                    <li>
                        Owned performance and reliability across the fleet: optimised a ~100M-row tenant database with targeted indexing and
                        caching, used Laravel Nightwatch to find and fix the next bottlenecks, and replaced a fragile manual deploy script with
                        a GitHub Actions pipeline that ended recurring out-of-memory failures and enabled fast, parallel multi-tenant deploys
                    </li>
                    <li>
                        Built a dual-sided referral programme handling real money—letting customers refer new customers for a cut, plus a
                        separate influencer tier with its own rates and rewards, with the reward and payout logic to back it
                    </li>
                    <li>
                        Built an on-demand image optimisation proxy (Intervention) that compiles and caches lean image variants on first
                        request, cutting page weight from oversized customer uploads across the site
                    </li>
                </ul>
            </div>

            {{-- Freelance Contracts --}}
            <div class="dark:bg-dark rounded-lg bg-white md:p-6 print:md:p-2">
                <div class="mb-6 flex flex-wrap items-start justify-between print:mb-3">
                    <div class="space-y-1.5">
                        <h3
                            class="text-pizza dark:text-pizza-dark text-xl font-bold print:mb-1 print:text-base print:font-semibold print:text-black"
                        >
                            Freelance
                        </h3>
                    </div>
                    <p class="dark:text-gray-400 print:text-black">02/2025 - Present</p>
                </div>

                {{-- App-Hive --}}
                <div
                    class="border-pizza/30 dark:border-pizza-dark/30 mb-6 border-l-2 pl-4 last:mb-0 print:mb-3 print:border-l print:border-gray-400 print:pl-2"
                >
                    <div class="mb-3 flex flex-wrap items-start justify-between print:mb-2">
                        <div class="space-y-1">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 print:text-sm print:text-black">
                                Fullstack Laravel Developer
                            </h4>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 print:text-xs print:text-black">App-Hive</p>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 print:text-xs print:text-black">11/2025 - Present</p>
                    </div>
                    <ul
                        class="list-inside list-disc space-y-2 text-sm text-gray-700 md:text-base dark:text-gray-300 print:space-y-1 print:text-xs print:leading-snug print:text-black"
                    >
                        <li>
                            Built and maintained Shopify plugins using the TALL stack (Tailwind, Alpine.js, Laravel, Livewire), implementing
                            features based on customer requests and requirements
                        </li>
                        <li>
                            Utilised AI agents to accelerate development workflows, shipping multiple features within tight delivery windows
                        </li>
                        <li>Contributed to plugin subscription growth by delivering features that directly addressed customer needs</li>
                    </ul>
                </div>

                {{-- Everyone Inc --}}
                <div
                    class="border-pizza/30 dark:border-pizza-dark/30 mb-6 border-l-2 pl-4 last:mb-0 print:mb-3 print:border-l print:border-gray-400 print:pl-2"
                >
                    <div class="mb-3 flex flex-wrap items-start justify-between print:mb-2">
                        <div class="space-y-1">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 print:text-sm print:text-black">
                                Full-stack Developer
                            </h4>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 print:text-xs print:text-black">Everyone Inc</p>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 print:text-xs print:text-black">06/2025 - 08/2025</p>
                    </div>
                    <ul
                        class="list-inside list-disc space-y-2 text-sm text-gray-700 md:text-base dark:text-gray-300 print:space-y-1 print:text-xs print:leading-snug print:text-black"
                    >
                        <li>
                            Collaborated with the management team and their client to rebuild the website from the ground up using the TALL
                            stack. Developed many of the front-end views with Blade, Tailwind CSS, and Alpine.js base
                        </li>
                    </ul>
                </div>

                {{-- NERIS Analytics --}}
                <div
                    class="border-pizza/30 dark:border-pizza-dark/30 mb-6 border-l-2 pl-4 last:mb-0 print:mb-3 print:border-l print:border-gray-400 print:pl-2"
                >
                    <div class="mb-3 flex flex-wrap items-start justify-between print:mb-2">
                        <div class="space-y-1">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 print:text-sm print:text-black">
                                Laravel Developer
                            </h4>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 print:text-xs print:text-black">
                                NERIS Analytics Limited
                            </p>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 print:text-xs print:text-black">02/2025 - 05/2025</p>
                    </div>
                    <ul
                        class="list-inside list-disc space-y-2 text-sm text-gray-700 md:text-base dark:text-gray-300 print:space-y-1 print:text-xs print:leading-snug print:text-black"
                    >
                        <li>
                            Worked closely with the development team via Linear to implement new features and streamline the backlog of
                            support tickets and bug fixes
                        </li>
                    </ul>
                </div>
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
                    <p class="dark:text-gray-400 print:text-black">08/2025 - 11/2025</p>
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
                        Monitored and resolved failed jobs and service outages, responding to automated alerts via Slack to minimise
                        downtime
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
                    <li>
                        Core member of a three-person team rebuilding the company's flagship software from the ground up using the TALL
                        stack (Tailwind, Alpine.js, Laravel, Livewire)
                    </li>
                    <li>
                        Delivered a complete mobile solution end-to-end—a cross-platform app (Vue.js + Ionic) and its supporting Laravel API
                        with Sanctum auth—independently learning the stack and shipping both to production within six months
                    </li>
                    <li>
                        Established and configured Laravel Vapor infrastructure, including dynamic per-PR environments for safer testing
                    </li>
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
                        Architected and implemented new features using Inertia.js, adapting to each client's technology requirements
                    </li>
                </ul>
            </div>

            <!-- LinkedIn Note -->
            <div class="mt-6 text-center print:hidden">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    For my complete work history, visit my
                    <a
                        class="text-pizza dark:text-pizza-dark hover:underline"
                        href="https://www.linkedin.com/in/chrismellor85"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        LinkedIn profile
                    </a>
                </p>
            </div>
        </section>

        <!-- Industry Engagement & Open Source -->
        <section>
            <h2 class="text-pizza dark:text-pizza-dark mb-4 text-2xl font-bold print:mb-2 print:text-lg print:text-black">
                Open Source & Side Projects
            </h2>
            <div class="dark:bg-dark rounded-lg bg-white">
                <p
                    class="text-sm leading-relaxed text-gray-700 md:text-base dark:text-gray-300 print:text-sm print:leading-tight print:text-black"
                >
                    The biggest change AI has made for me is that language and framework are no longer the barrier they used to be. When I
                    need something, I build it—whatever it takes. I wanted a better Markdown viewer, so I built one (Peek); I wanted a
                    voice-dictation tool, so I built that too—both well outside my day-to-day stack, and both built with the same care I'd
                    give production work, code and security reviewed rather than blindly trusted. In a role, that means I can help improve
                    things beyond a company's core stack, not just within it.
                    <br />
                    <br />
                    I've contributed to the Laravel ecosystem for years, creating and maintaining open source packages that have collectively
                    passed 1,000 stars on GitHub, with some featured on social media and reviewed on YouTube. I'd rather build and support my
                    own solution (or a fork) than lean on something unmaintained. Alongside publishing code, I stay close to the community
                    through newsletters, Laracasts, and discussion online.
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
                    Outside of work I love to travel—often solo, sometimes with my partner—usually after falling down a YouTube travel-vlog
                    rabbit hole. I'm into live music too, and the occasional festival when a favourite band is touring.
                </p>
            </div>
        </section>
    </main>
</x-layout.main>
