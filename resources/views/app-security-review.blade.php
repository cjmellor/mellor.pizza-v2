@php
    $checks = [
        ['icon' => 'key-round', 'title' => 'Exposed keys and secrets', 'detail' => 'API keys, service-role keys and tokens shipped to the browser or committed to the repo.'],
        ['icon' => 'database', 'title' => 'Database access rules', 'detail' => 'Who can read and write which rows. On Supabase that means row-level security; on Laravel, policies and mass assignment.'],
        ['icon' => 'lock', 'title' => 'Auth flows', 'detail' => 'Sign-up, login, password reset and session handling, and whether a logged-in user can reach another user\'s data.'],
        ['icon' => 'folder', 'title' => 'File storage', 'detail' => 'Public buckets and upload paths that leak private files.'],
        ['icon' => 'server', 'title' => 'Hosting and backups', 'detail' => 'Where it runs, whether backups exist and have ever been restored, and what happens when it goes down.'],
        ['icon' => 'package', 'title' => 'Runtime and dependency versions', 'detail' => 'Unpatched PHP, Node or packages with known vulnerabilities.'],
    ];
@endphp

<x-layout.main
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
    <main>
        <x-page-head
            title="App security review"
            label="03 — Security review"
        >
            <p class="lede">
                You built it fast, with Lovable, Supabase, an AI agent or a team in a hurry, and now real users are signing up. Before
                someone else finds the holes, I'll find them for you.
            </p>
            <p class="text-brand-ink text-xl font-bold">$750 fixed. Written report in 5 working days.</p>
        </x-page-head>

        <x-section
            title="What I check"
            label="01"
        >
            <ul
                class="grid gap-4 sm:grid-cols-2"
                role="list"
            >
                @foreach ($checks as $check)
                    <li class="flex">
                        <x-card
                            class="flex-1"
                            :heading="$check['title']"
                            :icon="$check['icon']"
                        >
                            {{ $check['detail'] }}
                        </x-card>
                    </li>
                @endforeach
            </ul>
        </x-section>

        <x-section
            title="What you get"
            label="02"
        >
            <x-card>
                <ul class="list-bullets text-[15px]/[1.7]">
                    <li>A written report with every issue ranked by how bad it is and how easy it is to exploit.</li>
                    <li>A plain-English explanation of each one, so you know what's at stake without being a developer.</li>
                    <li>A fix estimate for each issue.</li>
                    <li>If you hire me to make the fixes, the $750 comes off the bill.</li>
                </ul>
            </x-card>
        </x-section>

        <x-section
            title="Why me"
            label="03"
        >
            <div class="space-y-4">
                <p class="copy">
                    I'm a production engineer, not a scanner. I review everything AI writes, security included, because I don't take it on
                    trust. When the php2shell PHP vulnerability landed, I flagged it to my client's team on release day. On my own server
                    the OS packages couldn't deliver the fix, so I built a containerised PHP-FPM 8.4.27 the same day and moved three
                    production sites onto it with no downtime and a tested rollback.
                </p>
                <p class="copy">
                    Once the report's done, I can fix what it finds, and keep the app hosted, backed up and patched afterwards.
                </p>
            </div>
        </x-section>

        <x-contact-band
            title="Book a review"
            label="04"
            button="Get in touch"
        >
            Tell me what the app does and what it's built with. I'll reply with a start date.
        </x-contact-band>
    </main>
</x-layout.main>
