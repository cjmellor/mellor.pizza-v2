@php
    use App\Seo\Seo;

    $appHive = \App\Portfolio\Project::all()->firstWhere('name', 'App-Hive');

    $clients = ['Product teams with a Laravel or plain PHP codebase who need another developer. PoweredByRental is an example.', 'Agencies that need contract help on client work. App-Hive is a Shopify app agency.'];

    $steps = ['Map the problem', 'Write the spec', 'Break it into tickets', 'Implement with AI agents', 'Code & security review'];

    $faqs = [
        [
            'question' => 'Do you work on plain PHP, or only Laravel?',
            'answer' => 'Both. Laravel is my main framework, but my most recent contract was a plain PHP 8 back end with SQL Server and Vue 3 on the front.',
        ],
        [
            'question' => 'Do you use AI to write the code?',
            'answer' => 'Yes, mostly through Claude Code. I plan the work and write the spec first, and I review everything the AI writes, security included, before it merges.',
        ],
        [
            'question' => 'How soon can you start?',
            'answer' => 'I\'m available now.',
        ],
        [
            'question' => 'Who owns the code?',
            'answer' => 'You do. Once the work\'s paid for, everything\'s handed over: code, repo, keys and accounts.',
        ],
    ];
@endphp

<x-layout.main
    :schema="[
        Seo::webPage('WebPage', 'services.laravel-php-contractor'),
        Seo::service(
            name: 'Laravel & PHP contracting',
            description: 'Remote Laravel and PHP contract development: features, fixes, integrations and releases.',
            routeName: 'services.laravel-php-contractor',
        ),
        Seo::breadcrumbs(['homepage' => 'Home', 'services' => 'Services', 'services.laravel-php-contractor' => 'Laravel & PHP contracting']),
        Seo::faqPage($faqs),
    ]"
>
    <main>
        <x-page-head
            title="Remote Laravel & PHP contractor"
            label="03 — Services"
        >
            <flux:text class="lede">
                I'm a Laravel and PHP contractor. I join your team remotely through my company, Mellor Code Ltd, and own the work end to
                end: features, fixes, integrations and releases. I've been building software commercially for over six years, mostly in
                Laravel, and I'm available now.
            </flux:text>
            <flux:link
                href="{{ route('services') }}"
                wire:navigate.hover
            >
                All services
            </flux:link>
        </x-page-head>

        <x-section
            title="Who do I usually work with?"
            label="01"
        >
            <x-card>
                <ul class="list-bullets text-[15px]/[1.7]">
                    @foreach ($clients as $client)
                        <li>{{ $client }}</li>
                    @endforeach
                </ul>
            </x-card>
        </x-section>

        <x-section
            title="What can I take on?"
            label="02"
        >
            <ul
                class="grid gap-4 sm:grid-cols-2"
                role="list"
            >
                <li class="flex">
                    <x-card
                        class="flex-1"
                        heading="Features and fixes"
                    >
                        At App-Hive I'm effectively the sole developer on a Shopify app built with Laravel and Livewire. I've merged close
                        to 60 pull requests in eight months there: around 50 features and a dozen fixes.
                    </x-card>
                </li>
                <li class="flex">
                    <x-card
                        class="flex-1"
                        heading="Integrations"
                    >
                        At PoweredByRental I hardened the accounting integrations with Sage, Xero and QuickBooks: no more duplicate invoice
                        pushes, unmapped nominal codes refused, and payment actions put behind permissions.
                    </x-card>
                </li>
                <li class="flex">
                    <x-card
                        class="flex-1"
                        heading="Performance"
                    >
                        I cut the slowest production queries by up to 70×. One supplier report went from 7.9 s to 0.1 s.
                    </x-card>
                </li>
                <li class="flex">
                    <x-card
                        class="flex-1"
                        heading="Releases and production support"
                    >
                        Running releases and hotfixes, and handling Sentry alerts and database lock-ups for client tenants.
                    </x-card>
                </li>
                <li class="flex sm:col-span-2">
                    <x-card
                        class="flex-1"
                        heading="Security and upgrades"
                    >
                        Security-focused code review, PHP runtime upgrades and patching, and dependency audits with
                        <code>composer audit</code>
                        . For an app that was built in a hurry, see
                        <flux:link
                            href="{{ route('services.app-rescue') }}"
                            wire:navigate.hover
                        >
                            app rescue
                        </flux:link>
                        and the
                        <flux:link
                            href="{{ route('app-security-review') }}"
                            wire:navigate.hover
                        >
                            app security review
                        </flux:link>
                        .
                    </x-card>
                </li>
            </ul>
        </x-section>

        <x-section
            title="How do I work?"
            label="03"
        >
            <ol class="list-decimal space-y-1 ps-5 text-[15px]/[1.7]">
                @foreach ($steps as $step)
                    <li>{{ $step }}</li>
                @endforeach
            </ol>
            <flux:text class="copy">
                Claude Code is what I use day to day. Tests and CI are the merge gate, and I check every change myself before it goes in,
                whether I wrote it or an agent did.
                <flux:link
                    href="{{ route('cv') }}"
                    wire:navigate.hover
                >
                    The full write-up is on my CV
                </flux:link>
                .
            </flux:text>
        </x-section>

        <x-section
            title="Working with clients outside the UK"
            label="04"
        >
            <flux:text class="copy">
                I'm based in the UK (GMT/BST), one hour behind most of Europe, so my working day overlaps with UK and EU teams almost
                entirely. I invoice through Mellor Code Ltd, a UK limited company (company no. 17369266), on a business-to-business basis.
            </flux:text>
        </x-section>

        <x-section
            title="What have I worked on recently?"
            label="05"
        >
            <ul
                class="grid gap-4 sm:grid-cols-2"
                role="list"
            >
                <li class="flex">
                    <x-card
                        class="flex-1"
                        heading="PoweredByRental"
                    >
                        A 13-week contract on a multi-tenant SaaS for UK equipment hire companies (PHP 8, SQL Server, Vue 3). 650+ merged
                        pull requests across about 1,100 tickets.
                    </x-card>
                </li>
                <li class="flex">
                    <x-card
                        class="flex-1"
                        heading="App-Hive"
                    >
                        A Shopify app built with Laravel and Livewire.

                        <x-slot:footer>
                            <figure class="space-y-2">
                                <blockquote class="italic">“{{ $appHive->testimonial }}”</blockquote>
                                <figcaption>Philo, App-Hive</figcaption>
                            </figure>
                        </x-slot>
                    </x-card>
                </li>
            </ul>
            <flux:link
                href="{{ route('portfolio') }}"
                wire:navigate.hover
            >
                More in my portfolio
            </flux:link>
        </x-section>

        <x-faq
            :items="$faqs"
            label="05"
        />

        <x-contact-band
            title="Tell me about the project"
            label="06"
            button="Get in touch"
        >
            Send me what you're building and roughly how long you need someone. I reply the same day.
        </x-contact-band>
    </main>
</x-layout.main>
