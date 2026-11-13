@php
    $checks = [
        ['title' => 'Exposed keys and secrets', 'detail' => 'API keys, service-role keys and tokens shipped to the browser or committed to the repo.'],
        ['title' => 'Database access rules', 'detail' => 'Who can read and write which rows. On Supabase that means row-level security; on Laravel, policies and mass assignment.'],
        ['title' => 'Auth flows', 'detail' => 'Sign-up, login, password reset and session handling, and whether a logged-in user can reach another user\'s data.'],
        ['title' => 'File storage', 'detail' => 'Public buckets and upload paths that leak private files.'],
        ['title' => 'Hosting and backups', 'detail' => 'Where it runs, whether backups exist and have ever been restored, and what happens when it goes down.'],
        ['title' => 'Runtime and dependency versions', 'detail' => 'Unpatched PHP, Node or packages with known vulnerabilities.'],
    ];
@endphp

<x-layout.main
    container
    :schema="[
        App\Seo\Seo::webPage('WebPage', 'app-security-review'),
        App\Seo\Seo::service(
            name: 'App security review',
            description: 'A fixed-price security review of an app built fast: exposed keys, database access rules, auth flows, file storage, hosting and backups, and runtime versions. Written report in 5 working days.',
            routeName: 'app-security-review',
            offer: ['price' => '750', 'priceCurrency' => 'USD'],
        ),
    ]"
>
    <x-header />

    <main class="font-merriweather relative container my-20 mt-12 space-y-16 px-4 pt-0 md:px-12 lg:mt-0 lg:pt-40">
        <section class="max-w-prose space-y-6">
            <h1 class="text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100">App security review</h1>
            <p class="text-lg leading-8 text-zinc-700 dark:text-zinc-300">
                You built it fast, with Lovable, Supabase, an AI agent or a team in a hurry, and now real users are signing up. Before
                someone else finds the holes, I'll find them for you.
            </p>
            <p class="text-pizza dark:text-pizza-dark text-xl font-bold">$750 fixed. Written report in 5 working days.</p>
        </section>

        <section class="space-y-6">
            <h2 class="text-2xl font-semibold text-zinc-800 dark:text-zinc-100">What I check</h2>
            <ul class="grid gap-4 md:grid-cols-2">
                @foreach ($checks as $check)
                    <li class="bg-pizza/5 ring-pizza/20 dark:bg-dark dark:ring-dark-line space-y-1 rounded-lg p-5 ring-1">
                        <h3 class="font-bold text-zinc-800 dark:text-zinc-100">{{ $check['title'] }}</h3>
                        <p class="text-sm leading-6 text-zinc-700 dark:text-zinc-300">{{ $check['detail'] }}</p>
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="max-w-prose space-y-4">
            <h2 class="text-2xl font-semibold text-zinc-800 dark:text-zinc-100">What you get</h2>
            <ul class="list-outside list-disc space-y-2 pl-5 leading-7 text-zinc-700 dark:text-zinc-300">
                <li>A written report with every issue ranked by how bad it is and how easy it is to exploit.</li>
                <li>A plain-English explanation of each one, so you know what's at stake without being a developer.</li>
                <li>A fix estimate for each issue.</li>
                <li>If you hire me to make the fixes, the $750 comes off the bill.</li>
            </ul>
        </section>

        <section class="max-w-prose space-y-4">
            <h2 class="text-2xl font-semibold text-zinc-800 dark:text-zinc-100">Why me</h2>
            <p class="leading-7 text-zinc-700 dark:text-zinc-300">
                I'm a production engineer, not a scanner. I review everything AI writes, security included, because I don't take it on
                trust. When the php2shell PHP vulnerability landed, I flagged it to my client's team on release day. On my own server the OS
                packages couldn't deliver the fix, so I built a containerised PHP-FPM 8.4.27 the same day and moved three production sites
                onto it with no downtime and a tested rollback.
            </p>
            <p class="leading-7 text-zinc-700 dark:text-zinc-300">
                Once the report's done, I can fix what it finds, and keep the app hosted, backed up and patched afterwards.
            </p>
        </section>

        <section class="space-y-6 rounded-2xl bg-zinc-50 p-8 text-center ring-1 ring-zinc-200 dark:bg-zinc-900/40 dark:ring-zinc-700">
            <h2 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Book a review</h2>
            <p class="mx-auto max-w-2xl leading-7 text-zinc-600 dark:text-zinc-400">
                Tell me what the app does and what it's built with. I'll reply with a start date.
            </p>
            <flux:button
                class="bg-pizza dark:bg-pizza-dark hover:bg-orange-500 dark:hover:bg-pink-700"
                variant="primary"
                x-data
                x-on:click.prevent="$dispatch('show-contact')"
            >
                Get in touch
            </flux:button>
        </section>
    </main>
</x-layout.main>
