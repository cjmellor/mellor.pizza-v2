@php
    use App\Seo\Seo;

    $options = [
        [
            'icon' => 'code',
            'heading' => 'Laravel & PHP contracting',
            'situation' => 'You need another developer on a Laravel or PHP codebase.',
            'route' => 'services.laravel-php-contractor',
            'price' => null,
        ],
        [
            'icon' => 'shield',
            'heading' => 'App rescue',
            'situation' => 'Your app was built fast, it\'s live, and you\'re worried about what\'s exposed, slow or not backed up.',
            'route' => 'services.app-rescue',
            'price' => null,
        ],
        [
            'icon' => 'lock',
            'heading' => 'App security review',
            'situation' => 'You want to know what\'s wrong before you decide anything.',
            'route' => 'app-security-review',
            'price' => '$750 fixed, with a written report in 5 working days.',
        ],
    ];

    $facts = [
        'Business' => 'Mellor Code Ltd, registered in England and Wales, company no. 17369266',
        'Who you work with' => 'Chris Mellor, directly',
        'Where' => 'Remote, with clients worldwide. I work flexibly across time zones and can adapt to your team\'s working hours, whether you\'re in the UK, EU or US.',
        'Main stack' => 'Laravel, PHP 8, Livewire, Vue.js, Inertia.js, Alpine.js, Tailwind CSS',
        'Testing and delivery' => 'Pest, PHPUnit, CI, Docker',
        'Services' => 'Laravel & PHP contracting, app rescue, app security review',
        'Pricing' => 'Security review $750 fixed. I can quote in GBP, euro, or your local currency.',
        'Availability' => 'Available now',
        'Response time' => 'Same day',
    ];

    $faqs = [
        [
            'question' => 'Do you work with clients outside the UK?',
            'answer' => 'Yes. I work remotely and take on clients worldwide, including UK and EU teams. I invoice through Mellor Code Ltd, a UK limited company (company no. 17369266), on a business-to-business basis.',
        ],
        [
            'question' => 'Do you only work in Laravel?',
            'answer' => 'Laravel and PHP first, and other stacks when the job needs it. My most recent contract was a plain PHP 8 back end with no framework.',
        ],
        [
            'question' => 'Do you use AI to write code?',
            'answer' => 'Yes. AI writes a lot of my code, mostly through Claude Code, and I review all of it before it lands, security included.',
        ],
        [
            'question' => 'Who owns the code?',
            'answer' => 'You do. Once the work\'s paid for, I hand over everything: code, repo, keys and accounts.',
        ],
    ];

    $serviceNodes = [
        Seo::service(name: 'Laravel & PHP contracting', description: 'Remote Laravel and PHP contract development: features, fixes, integrations and releases.', routeName: 'services.laravel-php-contractor'),
        Seo::service(name: 'App rescue', description: 'Finding and fixing what is exposed or slow in apps built in a hurry, then keeping them hosted, backed up and patched.', routeName: 'services.app-rescue'),
        Seo::service(name: 'App security review', description: 'A fixed-price security review of an app built fast. Written report in 5 working days.', routeName: 'app-security-review', offer: ['price' => '750', 'priceCurrency' => 'USD']),
    ];
@endphp

<x-layout.main
    :schema="[
        [
            ...Seo::webPage('CollectionPage', 'services'),
            'mainEntity' => [
                '@type' => 'ItemList',
                'itemListElement' => array_map(
                    fn (array $node, int $index): array => ['@type' => 'ListItem', 'position' => $index + 1, 'item' => ['@id' => $node['@id']]],
                    $serviceNodes,
                    array_keys($serviceNodes),
                ),
            ],
        ],
        ...$serviceNodes,
        Seo::faqPage($faqs),
    ]"
>
    <main>
        <x-page-head
            title="Laravel & PHP services"
            label="03 — Services"
        >
            <flux:text class="lede">
                I'm Chris Mellor, a Laravel and PHP contractor working remotely through my company, Mellor Code Ltd. I do three kinds of
                work: contract development on your team, fixing apps that were built in a hurry, and a fixed-price security review. I'm
                available now and take on clients worldwide.
            </flux:text>
        </x-page-head>

        <x-section
            title="Which service do you need?"
            label="01"
        >
            <ul
                class="grid gap-4"
                role="list"
            >
                @foreach ($options as $option)
                    <li class="flex">
                        <x-card
                            class="flex-1"
                            :heading="$option['heading']"
                            :icon="$option['icon']"
                        >
                            <p>If: {{ $option['situation'] }}</p>
                            @if ($option['price'])
                                <p class="text-ink mt-2 font-semibold">{{ $option['price'] }}</p>
                            @endif

                            <x-slot:footer>
                                <flux:link
                                    href="{{ route($option['route']) }}"
                                    wire:navigate.hover
                                >
                                    {{ $option['heading'] }}
                                </flux:link>
                            </x-slot>
                        </x-card>
                    </li>
                @endforeach
            </ul>
        </x-section>

        <x-section
            title="How does working with me go?"
            label="02"
        >
            <flux:text class="copy">
                I reply the same day and keep you updated as the work moves. I write the spec first, then build, then do a code and security
                review before anything merges. I review everything before it lands, whether I wrote it or an AI agent did. Once the work's
                paid for, everything's handed over: code, repo, keys and accounts.
                <flux:link
                    href="{{ route('cv') }}"
                    wire:navigate.hover
                >
                    How I work, in full
                </flux:link>
            </flux:text>
        </x-section>

        <x-section
            title="Key facts"
            label="03"
        >
            <dl class="grid gap-x-6 gap-y-3 text-[15px]/[1.7] sm:grid-cols-[max-content_1fr]">
                @foreach ($facts as $term => $detail)
                    <dt class="text-ink font-semibold">{{ $term }}</dt>
                    <dd class="text-body">{{ $detail }}</dd>
                @endforeach

                <dt class="text-ink font-semibold">Recent clients</dt>
                <dd class="text-body">
                    PoweredByRental, App-Hive, 16Personalities.
                    <flux:link
                        href="{{ route('portfolio') }}"
                        wire:navigate.hover
                    >
                        See the portfolio
                    </flux:link>
                </dd>
            </dl>
        </x-section>

        <x-faq
            :items="$faqs"
            label="04"
        />

        <x-contact-band
            title="Tell me what you're building"
            label="05"
            button="Get in touch"
        >
            Send a few lines about the project and what you need. I reply the same day.
        </x-contact-band>
    </main>
</x-layout.main>
