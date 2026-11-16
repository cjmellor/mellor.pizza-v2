@php
    $projects = \App\Portfolio\Project::all();
    $pbr = $projects->firstWhere('name', 'PoweredByRental');
    $appHive = $projects->firstWhere('name', 'App-Hive');
@endphp

<main>
    <section class="nav:flex-row nav:items-stretch short:flex-row short:items-center relative flex flex-col">
        <div
            class="nav:flex-[0_0_280px] nav:px-6 nav:py-14 short:flex-[0_0_220px] short:px-4 short:py-6 flex flex-col items-center justify-center gap-3 px-6 pt-10 sm:px-10 sm:pt-12 lg:flex-[0_0_360px] lg:px-8 lg:py-18"
        >
            <x-face />

            <div class="mt-2 flex gap-1">
                <flux:button
                    href="https://x.com/cmellor"
                    aria-label="X"
                    variant="ghost"
                    icon="brand-x"
                    target="_blank"
                    tooltip="Follow me on X"
                />
                <flux:button
                    href="https://github.com/cjmellor"
                    aria-label="GitHub"
                    variant="ghost"
                    icon="brand-github"
                    target="_blank"
                    tooltip="Check out my GitHub"
                />
            </div>
        </div>

        <div
            class="rise-stagger nav:py-14 nav:pr-10 nav:pl-4 short:gap-4 short:py-6 short:pr-8 short:pl-0 flex min-w-0 flex-1 flex-col justify-center gap-6 px-6 pt-8 pb-14 sm:px-10 sm:pb-16 lg:gap-8 lg:py-18 lg:pr-14 lg:pl-6 xl:pl-14"
        >
            <hgroup class="flex flex-col gap-3">
                <span class="eyebrow flex items-center">
                    <span class="mr-2 size-2 rounded-full bg-lime-500 dark:bg-lime-300"></span>
                    Available now
                </span>

                <flux:heading
                    class="text-ink screen:font-black short:text-3xl/[1.12] text-4xl/[1.12] tracking-[-0.01em] lg:text-5xl/[1.12]"
                    level="1"
                    size="2xl"
                >
                    Laravel &amp; PHP contractor.
                    <span class="text-brand">Remote, worldwide.</span>
                </flux:heading>
            </hgroup>

            <flux:text class="text-ink-soft nav:text-xl/relaxed short:text-base max-w-[58ch] text-lg/relaxed">
                AI writes a lot of my code. I review all of it before it lands, security included, because I don't take it on trust.
            </flux:text>

            <div class="flex flex-wrap gap-3 max-sm:*:basis-full">
                <flux:button
                    href="{{ route('contact') }}"
                    variant="primary"
                    wire:navigate.hover
                >
                    Let's work together
                </flux:button>
                <flux:button
                    href="{{ route('app-security-review') }}"
                    wire:navigate.hover
                >
                    See the security review
                </flux:button>
            </div>
        </div>

        <x-rule bare />
    </section>

    <x-section
        title="What I do"
        label="01 — Services"
    >
        <x-slot:aside>
            <flux:text class="text-body text-sm/relaxed">Laravel and PHP first. Other stacks when the job needs it.</flux:text>
            <flux:link
                class="font-roboto-mono hover:text-ink inline-flex items-center gap-1 self-start text-xs tracking-[0.04em] uppercase"
                href="{{ route('services') }}"
                variant="ghost"
                wire:navigate.hover
            >
                See all services
                <flux:icon.arrow-right class="size-3.5" />
            </flux:link>
        </x-slot>

        <x-card
            heading="Laravel & PHP contracting"
            icon="code"
        >
            <x-slot:actions>
                <flux:button
                    href="{{ route('services.laravel-php-contractor') }}"
                    size="sm"
                    variant="ghost"
                    icon:trailing="arrow-right"
                    wire:navigate.hover
                >
                    See contracting
                </flux:button>
            </x-slot>
            I join your team remotely and own the work end to end: features, fixes, integrations and releases. Spec first, then the build,
            then a code and security review before anything merges.
        </x-card>

        <x-card
            heading="Rescue & hardening"
            icon="shield"
        >
            <x-slot:actions>
                <flux:button
                    href="{{ route('services.app-rescue') }}"
                    size="sm"
                    variant="ghost"
                    icon:trailing="arrow-right"
                    wire:navigate.hover
                >
                    See app rescue
                </flux:button>
                <flux:button
                    href="{{ route('app-security-review') }}"
                    size="sm"
                    variant="ghost"
                    icon:trailing="arrow-right"
                    wire:navigate.hover
                >
                    See the security review
                </flux:button>
            </x-slot>

            Your app was built fast, by a team in a hurry or with Lovable, Supabase or an AI agent, and now real users are on it. I find
            what's exposed or slow, fix it, and get it hosted, backed up and patched properly.
        </x-card>
    </x-section>

    <x-section
        title="Recent work"
        label="02 — Clients"
    >
        <x-slot:aside>
            <flux:link
                class="font-roboto-mono hover:text-ink inline-flex items-center gap-1 self-start text-xs tracking-[0.04em] uppercase"
                href="{{ route('portfolio') }}"
                variant="ghost"
                wire:navigate.hover
            >
                More in my portfolio
                <flux:icon.arrow-right class="size-3.5" />
            </flux:link>
        </x-slot>

        <x-card
            :heading="$pbr->name"
            :subheading="$pbr->url"
            :logo="$pbr->logo"
            :href="'https://' . $pbr->url"
        >
            Full-stack contract work on a multi-tenant SaaS platform for equipment hire companies, built on PHP 8, SQL Server and Vue 3.
        </x-card>

        <x-card
            :heading="$appHive->name"
            subheading="Shopify app, Laravel and Livewire"
            :logo="$appHive->logo"
            :href="'https://' . $appHive->url"
        >
            I built features and fixes alongside Philo, working from his issues and shipping each change through his review.

            <x-slot:footer>
                <figure class="space-y-2">
                    <blockquote class="italic">“{{ $appHive->testimonial }}”</blockquote>
                    <figcaption>Philo, App-Hive</figcaption>
                </figure>
            </x-slot>
        </x-card>
    </x-section>

    <x-section
        title="Working with me"
        label="03 — Process"
    >
        <x-card>
            <ul class="list-bullets">
                <li>I reply the same day and keep you updated as the work moves.</li>
                <li>I review everything before it lands, whether I wrote it or an AI agent did.</li>
                <li>Once the work's paid for, everything's handed over: code, repo, keys and accounts.</li>
            </ul>
        </x-card>

        <x-card>
            <div class="flex flex-wrap items-center justify-between gap-4">
                <x-chip icon="lock" />
                <flux:text class="text-ink min-w-50 flex-1 text-base">
                    Built something fast and not sure it's safe?
                    <span class="text-body">There's a fixed-price security review.</span>
                </flux:text>
                <flux:button
                    href="{{ route('app-security-review') }}"
                    wire:navigate.hover
                >
                    See what's checked
                </flux:button>
            </div>
        </x-card>
    </x-section>

    <x-section
        title="Tell me what you're building"
        label="04 — Contact"
        contact
    >
        <div class="flex flex-1 flex-col justify-end gap-4">
            <x-availability />
            <div class="flex flex-wrap gap-2">
                <flux:button
                    class="max-sm:basis-full"
                    href="{{ route('contact') }}"
                    variant="primary"
                    icon="message-square"
                    wire:navigate.hover
                >
                    Get in touch
                </flux:button>
                <flux:button
                    class="max-sm:flex-1"
                    href="mailto:chris@mellor.pizza"
                    aria-label="Email chris@mellor.pizza"
                    tooltip="chris@mellor.pizza"
                    icon="mail"
                />
                <flux:button
                    class="max-sm:flex-1"
                    href="https://www.linkedin.com/in/chrismellor85"
                    aria-label="LinkedIn"
                    icon="brand-linkedin"
                    target="_blank"
                />
            </div>
        </div>
    </x-section>
</main>
