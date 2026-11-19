@php
    $checks = [
        ['icon' => 'key-round', 'title' => 'Exposed keys and secrets', 'detail' => 'API keys, service-role keys and tokens shipped to the browser or committed to the repo.'],
        ['icon' => 'database', 'title' => 'Database access rules', 'detail' => 'Who can read and write which rows. On Laravel, that means policies and mass assignment.'],
        ['icon' => 'lock', 'title' => 'Auth flows', 'detail' => 'Sign-up, login, password reset and session handling, and whether a logged-in user can reach another user\'s data.'],
        ['icon' => 'folder', 'title' => 'File storage', 'detail' => 'Public buckets and upload paths that leak private files.'],
        ['icon' => 'server', 'title' => 'Hosting and backups', 'detail' => 'Where it runs, whether backups exist and have ever been restored, and what happens when it goes down.'],
        ['icon' => 'package', 'title' => 'Runtime and dependency versions', 'detail' => 'Unpatched PHP, Node or packages with known vulnerabilities.'],
    ];

    $faqs = [
        [
            'question' => 'Is this a penetration test?',
            'answer' => 'No. It\'s a review of the code and setup you share, with a written report. It isn\'t a penetration test, and it doesn\'t certify the app as secure.',
        ],
        [
            'question' => 'Can you invoice in another currency?',
            'answer' => 'The review is priced in US dollars. I\'m happy to quote the same amount in GBP, euro, or your local currency.',
        ],
        [
            'question' => 'What does the $750 include?',
            'answer' => 'A review of the code and setup you share, a written report in 5 working days, every issue ranked, a plain-English explanation, and a fix estimate for each. It isn\'t a penetration test and doesn\'t certify the app as secure.',
        ],
        [
            'question' => 'Do I have to hire you for the fixes?',
            'answer' => 'No. The report is yours. If you do hire me to make the fixes, the $750 comes off the bill. That\'s the [app rescue](' . route('services.app-rescue') . ') work.',
        ],
        [
            'question' => 'How do you handle personal data in the review?',
            'answer' => 'The review covers how the app stores and handles personal data, for example access control on user records, data exposed in API responses, logging of sensitive fields, and secrets in the repo. That matters if you have users in the UK or EU. It isn\'t a GDPR audit and doesn\'t make an app compliant.',
        ],
        [
            'question' => 'How soon can you start?',
            'answer' => 'Tell me what the app does and what it\'s built with. I\'ll reply the same day with a start date.',
        ],
        [
            'question' => 'Do I need the patch check or the full security review?',
            'answer' => 'The patch check covers the PHP runtime, the server and the upgrade path. The full review also covers your code, including keys, database access rules, auth flows, file storage, hosting and backups.',
        ],
        [
            'question' => 'Can you check servers set up with Laravel Forge or Docker?',
            'answer' => 'Yes. I check the PHP that\'s actually serving requests, whether Forge, a Docker image or the distro\'s packages installed it.',
        ],
        [
            'question' => 'Does the check include doing the upgrade?',
            'answer' => 'The check finds out what you\'re running and gives you a written plan. Applying the patch is $150 per server once you approve the plan. A bigger upgrade, like moving off PHP 8.2, is quoted separately, and the $295 comes off it if you book it within 30 days.',
        ],
        [
            'question' => 'What if we\'re still on PHP 8.2?',
            'answer' => 'PHP 8.2 gets security fixes until 31 December 2026, then none. The check tells you what\'s blocking a move to 8.4 or 8.5 and the order to do it in.',
        ],
    ];

    $patchCheckArticle = App\Articles\Article::find('php-8-2-end-of-life-laravel');

    $breadcrumbs = ['homepage' => 'Home', 'services' => 'Services', 'app-security-review' => 'App security review'];
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
        App\Seo\Seo::service(
            name: 'PHP patch and upgrade check',
            description: 'A fixed-price check of the PHP your servers actually run, whether it has the latest security fixes, and a written upgrade plan within one working day.',
            routeName: 'app-security-review',
            offer: ['price' => '295', 'priceCurrency' => 'USD'],
            anchor: 'php-patch-check',
        ),
        App\Seo\Seo::breadcrumbs($breadcrumbs),
        App\Seo\Seo::faqPage($faqs),
    ]"
>
    <main>
        <x-page-head
            title="A fixed-price security review for apps built fast"
            label="04 — Security review"
            :$breadcrumbs
        >
            <flux:text class="lede">
                You built it fast, with AI tools or a team in a hurry, and now real users are signing up. Before someone else finds the
                holes, I'll find them for you.
            </flux:text>
            <flux:text class="text-brand-ink text-xl font-bold">$750 fixed. Written report in 5 working days.</flux:text>
        </x-page-head>

        <x-section
            title="What does the review check?"
            label="01"
        >
            <flux:text class="copy">
                I read the code and setup you share and look for the problems that get apps into trouble, including how personal data is
                stored and exposed.
            </flux:text>
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
            <flux:text class="copy">
                The review also covers how the app stores and handles personal data: access control on user records, data exposed in API
                responses, logging of sensitive fields, and secrets in the repo. That matters if you have users in the UK or EU. It isn't a
                GDPR audit and doesn't make an app compliant.
            </flux:text>
        </x-section>

        <x-section
            title="What do you get?"
            label="02"
        >
            <flux:text class="copy">
                A written report in 5 working days, with every issue ranked, explained in plain English, and given a fix estimate.
            </flux:text>
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
            class="scroll-mt-24"
            id="php-patch-check"
            title="PHP patch and upgrade check"
            label="03"
        >
            <div class="space-y-4">
                <flux:text class="copy">
                    If you mainly want to know whether your PHP is patched and what to upgrade to, there's a smaller check. It's $295 fixed,
                    written up within one working day.
                </flux:text>
                <flux:text class="copy">
                    It's for teams who saw a PHP security release, such as October's php2shell fixes, and aren't sure their servers picked
                    it up. It's also for teams still on PHP 8.2, which stops getting security fixes on 31 December 2026.
                </flux:text>
            </div>

            <x-card heading="What I check">
                <ul class="list-bullets text-[15px]/[1.7]">
                    <li>
                        <strong>PHP and Laravel versions.</strong>
                        The exact PHP patch version on each server and in each Docker image, the Laravel version, and whether both still get
                        security fixes.
                    </li>
                    <li>
                        <strong>Whether the server is actually patched.</strong>
                        Servers set up by Forge or similar tools, Docker base images and distro packages can lag behind php.net. I check
                        what's running, not what
                        <code>composer.json</code>
                        says.
                    </li>
                    <li>
                        <strong>End-of-life dates.</strong>
                        PHP 8.2 security support ends on 31 December 2026. Laravel 11 security fixes ended on 12 March 2026.
                    </li>
                    <li>
                        <strong>Risky php.ini settings.</strong>
                        php.net advised turning off
                        <code>session.upload_progress.enabled</code>
                        in October. I also look at
                        <code>expose_php</code>
                        and
                        <code>display_errors</code>
                        in production, and the limits php.net listed as stopgaps for php2shell.
                    </li>
                    <li>
                        <strong>Upgrade path.</strong>
                        Which PHP version to move to, 8.4 or 8.5, which Composer packages block it, and the order to do it in.
                    </li>
                </ul>
            </x-card>

            <x-card heading="What you get">
                <ul class="list-bullets text-[15px]/[1.7]">
                    <li>A short written report on what's running, what's out of date and what to change first.</li>
                    <li>A written upgrade plan with steps, risks and a rough time estimate.</li>
                    <li>Once you approve the plan, I can apply the patch for $150 per server.</li>
                    <li>If you book the full security review or the upgrade work within 30 days, the $295 comes off that bill.</li>
                </ul>
            </x-card>

            <flux:text class="copy">The next section has an example of this work, from the day the php2shell fixes came out.</flux:text>

            <div>
                <flux:button
                    href="{{ route('contact') }}"
                    variant="primary"
                    wire:navigate.hover
                >
                    Ask for a patch check
                </flux:button>
            </div>

            <flux:text class="copy">
                If something needs fixing,
                <flux:link
                    href="{{ route('services.app-rescue') }}"
                    wire:navigate.hover
                >
                    app rescue
                </flux:link>
                covers the fix work.
                @if ($patchCheckArticle)
                    <flux:link
                        href="{{ $patchCheckArticle->url() }}"
                        wire:navigate.hover
                    >
                        PHP 8.2 end of life and the November 2026 security release
                    </flux:link>
                    explains what changed on 19 November.
                @endif
            </flux:text>
        </x-section>

        <x-section
            title="Why ask me to review it?"
            label="03"
        >
            <flux:text class="copy">
                I'm a production engineer, not a scanner. I review everything AI writes, security included, because I don't take it on
                trust. When the php2shell PHP vulnerability landed, I flagged it to my client's team on release day. On my own server the OS
                packages couldn't deliver the fix, so I built a containerised PHP-FPM 8.4.27 the same day and moved three production sites
                onto it with no downtime and a tested rollback.
            </flux:text>
        </x-section>

        <x-section
            title="What happens after the report?"
            label="04"
        >
            <div class="space-y-4">
                <flux:text class="copy">
                    You can keep the report and fix the issues yourself, or hire me to fix them. If you do, the $750 comes off the bill.
                </flux:text>
                <flux:text class="copy">
                    Once the report's done,
                    <flux:link
                        href="{{ route('services.app-rescue') }}"
                        wire:navigate.hover
                    >
                        I can fix what it finds
                    </flux:link>
                    , and quote for keeping the app hosted, backed up and patched afterwards. If you then need a developer on your team, see
                    <flux:link
                        href="{{ route('services.laravel-php-contractor') }}"
                        wire:navigate.hover
                    >
                        Laravel & PHP contracting
                    </flux:link>
                    .
                    <flux:link
                        href="{{ route('services') }}"
                        wire:navigate.hover
                    >
                        All services
                    </flux:link>
                </flux:text>
            </div>
        </x-section>

        <x-faq
            :items="$faqs"
            label="05"
        />

        <x-contact-band
            title="Book a review"
            label="06"
            button="Get in touch"
        >
            Tell me what the app does and what it's built with. I'll reply with a start date.
        </x-contact-band>
    </main>
</x-layout.main>
