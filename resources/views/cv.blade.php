@php
    $printLinks = [
        ['icon' => 'mail-outline', 'href' => 'mailto:chris@mellor.pizza', 'text' => 'chris@mellor.pizza'],
        ['icon' => 'github-outline', 'href' => 'https://github.com/cjmellor', 'text' => 'cjmellor'],
        ['icon' => 'x-outline', 'href' => 'https://x.com/cmellor', 'text' => '@cmellor'],
    ];

    $steps = ['Map the problem', 'Write the spec', 'Break it into tickets', 'Implement with AI agents', 'Code & security review'];

    $skills = [
        'AI-Native Delivery' => [
            'Spec-first planning before agents build',
            'Parallel agent workflows (Claude Code)',
            'Tests & CI as the merge gate',
            'AI-assisted code & security review',
            'Comfortable across other models & harnesses',
        ],
        'Core Stack' => ['Laravel / PHP', 'Livewire', 'Vue.js & Inertia.js', 'Alpine.js', 'Tailwind CSS'],
        'Platform & Practices' => ['Pest / PHPUnit', 'CI / CD', 'Docker', 'Linux & web infrastructure'],
        'Security & Upgrades' => [
            'Security-focused code review (OWASP Top 10)',
            'PHP runtime upgrades & patching',
            'Dependency auditing (composer audit)',
            'Linux, PHP-FPM & web-server hardening',
        ],
    ];
@endphp

<x-layout.main :schema="[App\Seo\Seo::webPage('ProfilePage', 'cv')]">
    <main class="relative print:container print:my-8 print:space-y-5 print:px-4 print:pt-0 print:text-sm print:leading-tight">
        <x-page-head
            class="print:mb-6 print:block print:p-0 print:text-center"
            title="Chris Mellor"
            label="01 — CV"
        >
            <p class="text-ink-soft text-lg/relaxed print:text-sm print:leading-tight print:text-black">
                <strong class="screen:text-ink font-semibold">Full-Stack Laravel &amp; Vue Engineer</strong>
                <span class="screen:mx-2">·</span>
                AI-native delivery
                <span class="screen:mx-2">·</span>
                Remote
            </p>

            <p
                class="text-muted max-w-[62ch] text-[15px]/[1.7] text-balance print:mt-1 print:max-w-none print:text-xs print:leading-tight print:text-black"
            >
                I ship production software by writing the spec, steering coding agents and verifying what lands, mostly on Laravel.
            </p>

            <div class="flex flex-wrap gap-2 print:hidden">
                <flux:button
                    class="max-sm:flex-1"
                    href="mailto:chris@mellor.pizza"
                    icon="mail"
                >
                    Email
                </flux:button>
                <flux:button
                    class="max-sm:flex-1"
                    href="https://github.com/cjmellor"
                    icon="brand-github"
                >
                    GitHub
                </flux:button>
                <flux:button
                    class="max-sm:flex-1"
                    href="https://x.com/cmellor"
                    aria-label="X"
                    icon="brand-x"
                />
            </div>

            <div class="hidden print:mt-6 print:flex print:flex-wrap print:justify-center print:gap-8 print:text-xs">
                @foreach ($printLinks as $link)
                    <a
                        class="flex items-center gap-2"
                        href="{{ $link['href'] }}"
                    >
                        <flux:icon
                            class="h-5 w-5"
                            :icon="$link['icon']"
                        />
                        <span>{{ $link['text'] }}</span>
                    </a>
                @endforeach
            </div>

            <div class="absolute top-18 right-14 hidden xl:block print:hidden">
                <flux:button
                    variant="primary"
                    icon="printer"
                    x-data
                    x-on:click="window.print()"
                >
                    Print
                </flux:button>
            </div>
        </x-page-head>

        <x-section
            title="Professional Summary"
            label="01"
        >
            <p class="cv-prose">
                I've been building software commercially for over six years, with the better part of a decade in tech before I moved into
                development proper.
                <br />
                <br />
                The way I build software has changed. These days I write less of it line by line and spend more time directing the work: I
                plan it properly first, get the spec and the edge cases sorted before anything gets built, then let AI agents handle the
                implementation. It means I ship more, and ship it faster, but the standards haven't slipped: the decisions and the review
                are still mine.
                <br />
                <br />
                I'm not just guessing and hoping something works. I know Laravel well, I'm more than comfortable on the front-end, and I've
                got enough range across everything else to stay in control of the code rather than just accepting it—and I review everything
                the AI writes, security included, because I don't take it on trust. That means keeping PHP runtimes and dependencies
                patched, and moving fast when something like php2shell lands. Laravel is my main framework, but I'm just as at home in plain
                PHP: my most recent contract was a vanilla PHP 8 back end with no framework.
            </p>
        </x-section>

        <x-section
            title="How I Work"
            label="02"
        >
            <div class="screen:panel">
                <div class="screen:panel-body screen:flex screen:flex-col screen:gap-4 screen:text-[15px]/7">
                    <p class="cv-text print:mb-2">
                        I've settled into a way of working that does most of the thinking up front, before any code exists. By the time I
                        start building, the hard decisions are already made, so it lands clean and rarely needs much reworking:
                    </p>
                    <ol
                        class="screen:font-roboto-mono screen:text-xs screen:tracking-[0.04em] screen:text-ink-soft screen:uppercase flex flex-wrap items-center gap-2 font-mono font-medium whitespace-nowrap print:mb-2 print:ml-4 print:gap-y-1 print:text-sm print:text-black"
                    >
                        @foreach ($steps as $step)
                            @unless ($loop->first)
                                <li
                                    class="text-brand print:text-pizza shrink-0"
                                    aria-hidden="true"
                                >
                                    →
                                </li>
                            @endunless

                            <li class="screen:step-chip shrink-0">{{ $step }}</li>
                        @endforeach
                    </ol>
                    <p class="cv-text">
                        Claude Code is what I use day to day, with Anthropic's models doing the work. I keep an eye on the other models and
                        tools out there, but this setup has worked so well I've had no reason to move off it. And when I catch myself doing
                        the same thing more than once, I'll turn it into a reusable skill so I never have to work it out from scratch again.
                        Security review works the same way: AI agents sweep the code and its dependencies, and I check every finding myself
                        before anything gets fixed.
                    </p>
                </div>
            </div>
        </x-section>

        <x-section
            class="print:break-before-page"
            title="Technical Skills"
            label="03"
        >
            <div
                class="grid grid-cols-[repeat(auto-fit,minmax(min(320px,100%),1fr))] gap-4 print:break-inside-avoid print:grid-cols-4 print:gap-4"
            >
                @foreach ($skills as $group => $items)
                    <div class="screen:panel print:border-l print:border-gray-200 print:pl-4 print:first:border-l-0 print:first:pl-0">
                        <h3 class="screen:text-ink screen:px-5 screen:py-3 font-bold print:mb-3 print:text-black">{{ $group }}</h3>
                        <ul
                            class="screen:panel-body screen:list-disc screen:pl-9 screen:marker:text-brand space-y-2 print:space-y-0.5 print:text-black"
                        >
                            @foreach ($items as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </x-section>

        <x-section
            title="Professional Experience"
            label="04"
        >
            <flux:timeline
                class="phone:timeline-flat [--color-accent:var(--color-pizza)] [--flux-timeline-content-gap:1rem] [--flux-timeline-item-gap:2.5rem] [print-color-adjust:exact] dark:[--color-accent:var(--color-pizza-dark)] print:[--flux-timeline-item-gap:1.25rem]"
                align="start"
            >
                <x-cv.role
                    title="Freelance"
                    dates="02/2025 - Present"
                    current
                    group
                >
                    <flux:timeline
                        class="phone:mt-5 phone:timeline-flat mt-6 [--flux-timeline-content-gap:0.875rem] [--flux-timeline-item-gap:1.5rem] print:mt-3 print:[--flux-timeline-item-gap:0.75rem]"
                        align="start"
                    >
                        <x-cv.role
                            title="Full-stack Engineer"
                            dates="08/2026 - 10/2026"
                            org="PoweredByRental"
                            context="Multi-tenant SaaS platform for UK equipment hire companies (PHP 8, SQL Server, Vue 3 + TypeScript, RabbitMQ)."
                            nested
                        >
                            <li>
                                Shipped 650+ merged pull requests across about 1,100 tickets in 13 weeks, including High and Highest
                                priority production bugs
                            </li>
                            <li>
                                Flagged the critical php2shell PHP remote-code-execution vulnerability to the team on release day, alongside
                                running releases and hotfixes and handling production support for client tenants (Sentry alerts,
                                post-release database lock-ups)
                            </li>
                            <li>
                                Cut the slowest production queries by up to 70×: a supplier report from 7.9 s to 0.1 s, global search from
                                13.7 s to 2.0 s, and an invoice picker that loaded all ~240,000 invoices every time it opened (up to 25 s)
                                rebuilt to search on the server a page at a time
                            </li>
                            <li>
                                Hardened the accounting integrations with Sage, Xero and QuickBooks: no more duplicate invoice pushes,
                                unmapped nominal codes refused, and payment actions put behind permissions
                            </li>
                            <li>
                                Worked test-first, adding PHPUnit and Vitest coverage plus CI guards that fail the build if a known bug ever
                                returns, and ran an automated QA pass on my own tickets before hand-off, so they reached the tester with no
                                defects found
                            </li>
                            <li>
                                Designed a workflow that runs a sprint's tickets through parallel Claude Code sessions: briefing each agent,
                                opening PRs, merging once checks pass and posting notes for the tester. It more than doubled monthly merged
                                PRs, with CI and QA as the gate
                            </li>
                        </x-cv.role>

                        <x-cv.role
                            title="Fullstack Laravel Developer"
                            dates="11/2025 - Present"
                            org="App-Hive"
                            current
                            nested
                        >
                            <li>
                                Built and maintained a Shopify plugin using the TALL stack (Tailwind, Alpine.js, Laravel, Livewire),
                                implementing features based on customer requests and requirements
                            </li>
                            <li>
                                Built these the same way I work now—planning up front, then implementing with AI agents—which is what let me
                                turn features around quickly on tight deadlines
                            </li>
                            <li>
                                Effectively the sole developer on the product—building from the maintainer's issues and shipping through his
                                review—I've merged close to 60 pull requests in eight months: around 50 features and a dozen fixes
                            </li>
                        </x-cv.role>

                        <x-cv.role
                            title="Full-stack Developer"
                            dates="06/2025 - 08/2025"
                            org="Everyone Inc"
                            nested
                        >
                            <li>
                                Collaborated with the management team and their client to rebuild the website from the ground up using the
                                TALL stack. Developed many of the front-end views with Blade, Tailwind CSS, and Alpine.js base
                            </li>
                        </x-cv.role>

                        <x-cv.role
                            title="Laravel Developer"
                            dates="02/2025 - 05/2025"
                            org="NERIS Analytics Limited"
                            nested
                        >
                            <li>
                                Worked closely with the development team via Linear to implement new features and streamline the backlog of
                                support tickets and bug fixes
                            </li>
                        </x-cv.role>
                    </flux:timeline>
                </x-cv.role>

                <x-cv.role
                    title="Software Engineer"
                    dates="04/2026 - 07/2026"
                    org="Right Global Group"
                    context="Full-stack engineer on a multi-tenant prize-competitions platform (Laravel, Inertia, Vue 3, MariaDB, Redis / Horizon) running roughly 30 production tenant sites. Everything below was built with my AI-first, spec-driven workflow."
                >
                    <li>
                        Designed and built an in-house SMS marketing platform end-to-end—letting tenants message their customers with
                        reusable recipient lists, a rules-based automation engine (e.g. an SMS triggered when a new customer registers and
                        makes a purchase), and campaign analytics
                    </li>
                    <li>
                        Laid the groundwork for the company's move to a self-service SaaS on Laravel Cloud, standing up automated per-tenant
                        app provisioning and porting the platform from MariaDB to PostgreSQL where Cloud required it
                    </li>
                    <li>
                        Optimised a ~100M-row tenant database with targeted indexing and caching, used Laravel Nightwatch to find and fix
                        the next bottlenecks, and replaced a fragile manual deploy script with a GitHub Actions pipeline that ended
                        recurring out-of-memory failures and enabled fast, parallel multi-tenant deploys
                    </li>
                    <li>
                        Built a dual-sided referral programme—letting customers refer new customers for a cut, plus a separate influencer
                        tier with its own rates and rewards, with the reward and payout logic to back it
                    </li>
                    <li>
                        Built an on-demand image optimisation proxy (Intervention) that compiles and caches lean image variants on first
                        request, cutting page weight from oversized customer uploads across the site
                    </li>
                </x-cv.role>

                <x-cv.role
                    title="Senior Laravel Developer"
                    dates="08/2025 - 11/2025"
                    org="Townsend Music"
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
                </x-cv.role>

                <x-cv.role
                    title="Laravel Developer"
                    dates="01/2022 - 11/2024"
                    org="59club Ltd"
                >
                    <li>
                        Core member of a three-person team rebuilding the company's flagship software from the ground up using the TALL
                        stack (Tailwind, Alpine.js, Laravel, Livewire)
                    </li>
                    <li>
                        Delivered a complete mobile solution end-to-end—a cross-platform app (Vue.js + Ionic) and its supporting Laravel API
                        secured with Sanctum token auth—independently learning the stack and shipping both to production within six months
                    </li>
                    <li>
                        Established and configured Laravel Vapor infrastructure, including dynamic per-PR environments for safer testing
                    </li>
                </x-cv.role>

                <x-cv.role
                    title="PHP Developer"
                    dates="06/2021 - 12/2021"
                    org="Jump Twenty Four Ltd"
                >
                    <li>
                        Led multiple client projects in an agency environment, focusing on modernising legacy PHP applications onto
                        supported, patched PHP and Laravel versions
                    </li>
                    <li>Architected and implemented new features using Inertia.js, adapting to each client's technology requirements</li>
                </x-cv.role>
            </flux:timeline>

            <p class="text-muted text-sm print:hidden">
                For my complete work history, visit my
                <a
                    class="text-brand-ink hover:underline"
                    href="https://www.linkedin.com/in/chrismellor85"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    LinkedIn profile
                </a>
            </p>
        </x-section>

        <x-section
            title="Open Source & Side Projects"
            label="05"
        >
            <p class="cv-prose">
                The biggest change AI has made for me is that language and framework are no longer the barrier they used to be. When I need
                something, I build it—whatever it takes. I wanted a better Markdown viewer, so I built one; I wanted a voice-dictation tool,
                so I built that too—both well outside my day-to-day stack, and both built with the same care I'd give production work, code
                and security reviewed rather than blindly trusted. In a role, that means I can help improve things beyond a company's core
                stack, not just within it.
                <br />
                <br />
                I run my own production server too. When php2shell landed and the server's OS packages couldn't deliver the fix, I built a
                containerised PHP-FPM 8.4.27 the same day and moved three production sites onto it with no downtime and a tested rollback.
                <br />
                <br />
                I've contributed to the Laravel ecosystem for years, creating and maintaining open source packages that have collectively
                passed 1,000 stars on GitHub, with some featured on social media and reviewed on YouTube. I'd rather build and support my
                own solution (or a fork) than lean on something unmaintained. Alongside publishing code, I stay close to the community
                through newsletters, Laracasts, and discussion online.
            </p>
        </x-section>

        <x-section
            title="Interests"
            label="06"
        >
            <p class="cv-prose">
                Outside of work I love to travel—often solo, sometimes with my partner—usually after falling down a YouTube travel-vlog
                rabbit hole. I'm into live music too, and the occasional festival when a favourite band is touring.
            </p>
        </x-section>
    </main>
</x-layout.main>
