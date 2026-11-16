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
            'question' => 'Can you take over hosting?',
            'answer' => 'Yes. Once the fixes are in, I can keep the app hosted, backed up and patched.',
        ],
        [
            'question' => 'Who owns everything afterwards?',
            'answer' => 'You do. Code, repo, keys and accounts are all handed over once the work\'s paid for.',
        ],
    ];
@endphp

<x-layout.main
    :schema="[
        Seo::webPage('WebPage', 'services.app-rescue'),
        Seo::service(
            name: 'App rescue',
            description: 'Finding and fixing what is exposed or slow in apps built in a hurry, then keeping them hosted, backed up and patched.',
            routeName: 'services.app-rescue',
        ),
        Seo::breadcrumbs(['homepage' => 'Home', 'services' => 'Services', 'services.app-rescue' => 'App rescue']),
        Seo::faqPage($faqs),
    ]"
>
    <main>
        <x-page-head
            title="Fixing apps that were built in a hurry"
            label="03 — Services"
        >
            <flux:text class="lede">
                If your app was built fast, by a team in a hurry or with Lovable, Supabase or an AI agent, and real users are on it now, I
                can make it safe to keep running. I find what's exposed or slow, fix it, and get it hosted, backed up and patched properly.
            </flux:text>
            <flux:link
                href="{{ route('services') }}"
                wire:navigate.hover
            >
                All services
            </flux:link>
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
                        Exposed keys and secrets, database access rules (row-level security on Supabase, policies and mass assignment on
                        Laravel), auth flows, and file storage.
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
            <ol class="list-decimal space-y-2 ps-5 text-[15px]/[1.7]">
                <li>
                    It starts with the
                    <flux:link
                        href="{{ route('app-security-review') }}"
                        wire:navigate.hover
                    >
                        app security review
                    </flux:link>
                    : $750 fixed, with a written report in 5 working days, every issue ranked, and a fix estimate for each.
                </li>
                <li>We agree which fixes to make, using those estimates.</li>
                <li>I make the fixes and review each one before it lands. If you hire me for the fixes, the $750 comes off the bill.</li>
                <li>If you want, I keep the app hosted, backed up and patched afterwards.</li>
            </ol>
        </x-section>

        <x-section
            title="Why trust me with it?"
            label="04"
        >
            <flux:text class="copy">
                When the php2shell PHP vulnerability landed, I flagged it to my client's team on release day. On my own server, I moved
                three production sites onto a patched PHP build the same day, with no downtime.
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

        <x-contact-band
            title="Tell me what the app does"
            label="06"
            button="Get in touch"
        >
            Tell me what it's built with and what's worrying you. I reply the same day.
        </x-contact-band>
    </main>
</x-layout.main>
