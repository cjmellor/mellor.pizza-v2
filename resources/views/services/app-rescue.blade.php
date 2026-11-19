@php
    use App\Seo\Seo;

    $situations = [
        'The app is live and people are signing up, but nobody has checked who can read what in the database.',
        'Keys or tokens may have ended up in the browser or the repo.',
        'You\'re not sure the backups exist, or whether one has ever been restored.',
        'Pages are getting slower as the data grows.',
    ];

    $faqs = [
        [
            'question' => 'Do I have to start with the review?',
            'answer' => 'Yes. I need to read the code before I can give you a price for the fixes. The review is a fixed $750, and that fee comes off the fix work if you go ahead with me.',
        ],
        [
            'question' => 'Is this a penetration test?',
            'answer' => 'No. It\'s a review of the code and setup you share, with a written report. It isn\'t a penetration test, and it doesn\'t certify the app as secure.',
        ],
        [
            'question' => 'Can you take over hosting?',
            'answer' => 'Once the fixes are in, I can quote for hosting, backups and patching. I don\'t publish a monthly price, because it depends on the app.',
        ],
        [
            'question' => 'Can you invoice in another currency?',
            'answer' => 'The review is priced in US dollars. I\'m happy to quote the same amount in GBP, euro, or your local currency.',
        ],
        [
            'question' => 'Who owns everything afterwards?',
            'answer' => 'You do. Code, repo, keys and accounts are all handed over once the work\'s paid for.',
        ],
        [
            'question' => 'What stacks do you rescue?',
            'answer' => 'Laravel and PHP first, and other stacks when the job needs it. My most recent contract was a plain PHP 8 back end.',
        ],
    ];

    $breadcrumbs = ['homepage' => 'Home', 'services' => 'Services', 'services.app-rescue' => 'App rescue'];
@endphp

<x-layout.main
    :schema="[
        Seo::webPage('WebPage', 'services.app-rescue'),
        Seo::service(
            name: 'App rescue',
            description: 'Finding and fixing what is exposed or slow in apps built in a hurry, then keeping them hosted, backed up and patched.',
            routeName: 'services.app-rescue',
        ),
        Seo::breadcrumbs($breadcrumbs),
        Seo::faqPage($faqs),
    ]"
>
    <main>
        <x-page-head
            title="Fixing apps that were built in a hurry"
            label="03 — Services"
            :$breadcrumbs
        >
            <flux:text class="lede">
                If your app was built fast, by a team in a hurry or with AI tools, and real users are on it now, I can make it safer to keep
                running. I find what's exposed or slow, fix it, and get it hosted, backed up and patched properly.
            </flux:text>
            <flux:text class="text-body">
                Need another developer on your team instead? See
                <flux:link
                    href="{{ route('services.laravel-php-contractor') }}"
                    wire:navigate.hover
                >
                    Laravel & PHP contracting
                </flux:link>
                .
            </flux:text>
        </x-page-head>

        <x-section
            title="Is this for you?"
            label="01"
        >
            <flux:text class="copy">
                This is for live Laravel or PHP apps that were built quickly and haven't had a proper security, performance or hosting
                check.
            </flux:text>
            <x-card>
                <ul class="list-bullets text-[15px]/[1.7]">
                    @foreach ($situations as $situation)
                        <li>{{ $situation }}</li>
                    @endforeach
                </ul>
            </x-card>
        </x-section>

        <x-section
            title="What does a rescue cover?"
            label="02"
        >
            <flux:text class="copy">
                A rescue covers security fixes, performance, hosting, backups and patching, then a full handover of the code, repo, keys and
                accounts.
            </flux:text>
            <ul
                class="grid gap-4 sm:grid-cols-2"
                role="list"
            >
                <li class="flex">
                    <x-card
                        class="flex-1"
                        heading="Security fixes"
                        icon="key-round"
                    >
                        Exposed keys and secrets, database access rules (policies and mass assignment on Laravel), auth flows, and file
                        storage.
                    </x-card>
                </li>
                <li class="flex">
                    <x-card
                        class="flex-1"
                        heading="Performance"
                        icon="database"
                    >
                        Slow queries and pages that load too much. At PoweredByRental I rebuilt an invoice picker that loaded all ~240,000
                        invoices every time it opened, so it now searches on the server a page at a time.
                    </x-card>
                </li>
                <li class="flex">
                    <x-card
                        class="flex-1"
                        heading="Hosting, backups and patching"
                        icon="server"
                    >
                        Somewhere sensible to run it, backups that have been restored at least once, and PHP, Node and packages kept up to
                        date.
                    </x-card>
                </li>
                <li class="flex">
                    <x-card
                        class="flex-1"
                        heading="Handover"
                        icon="package"
                    >
                        You get the code, repo, keys and accounts.
                    </x-card>
                </li>
            </ul>
        </x-section>

        <x-section
            title="How does a rescue work?"
            label="03"
        >
            <flux:text class="copy">
                It starts with the fixed-price security review. We then agree which fixes to make, I make them, and I can quote for ongoing
                hosting if you want it.
            </flux:text>
            <ol class="list-decimal space-y-2 ps-5 text-[15px]/[1.7]">
                <li>
                    It starts with the
                    <flux:link
                        href="{{ route('app-security-review') }}"
                        wire:navigate.hover
                    >
                        app security review
                    </flux:link>
                    : $750 fixed, with a written report in 5 working days, every issue ranked, and a fix estimate for each. The price is in
                    US dollars. I'm happy to quote the same amount in GBP, euro, or your local currency if that's easier.
                </li>
                <li>We agree which fixes to make, using those estimates.</li>
                <li>I make the fixes and review each one before it lands. If you hire me for the fixes, the $750 comes off the bill.</li>
                <li>If you want, I can quote for keeping the app hosted, backed up and patched afterwards.</li>
            </ol>
        </x-section>

        <x-section
            title="Why trust me with it?"
            label="04"
        >
            <flux:text class="copy">
                I'm a production engineer. When the php2shell PHP vulnerability landed, I flagged it to my client's team on release day. On
                my own server, I moved three production sites onto a patched PHP build the same day, with no downtime.
                <flux:link
                    href="{{ route('app-security-review') }}"
                    wire:navigate.hover
                >
                    More on the security review page
                </flux:link>
                .
            </flux:text>
        </x-section>

        <x-faq
            :items="$faqs"
            label="05"
        />

        <x-section
            title="Related services"
            label="06"
        >
            <ul class="list-bullets text-[15px]/[1.7]">
                <li>
                    <flux:link
                        href="{{ route('app-security-review') }}"
                        wire:navigate.hover
                    >
                        App security review
                    </flux:link>
                    is the $750 review that a rescue starts with.
                </li>
                <li>
                    <flux:link
                        href="{{ route('services.laravel-php-contractor') }}"
                        wire:navigate.hover
                    >
                        Laravel & PHP contracting
                    </flux:link>
                    is for when you need a developer on the team after the fixes.
                </li>
            </ul>
        </x-section>

        <x-contact-band
            title="Tell me what the app does"
            label="07"
            button="Get in touch"
        >
            Tell me what it's built with and what's worrying you. I reply the same day.
        </x-contact-band>
    </main>
</x-layout.main>
