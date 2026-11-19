@php
    $faqs = [
        [
            'question' => 'How quickly do you reply?',
            'answer' => 'The same day. I\'m available now.',
        ],
        [
            'question' => 'What should I include in the message?',
            'answer' => 'A short description of the app, the stack, and what you need.',
        ],
    ];
@endphp

<x-layout.main :schema="[App\Seo\Seo::webPage('ContactPage', 'contact'), App\Seo\Seo::faqPage($faqs)]">
    <main>
        <x-page-head
            title="Tell me what you're building"
            label="05 — Contact"
        >
            <x-availability dot />

            <flux:text class="text-body">
                I work flexibly across time zones and can adapt to your team's working hours, whether you're in the UK, EU or US.
            </flux:text>

            <flux:text class="text-body">
                Not sure what to ask for? See
                <flux:link
                    href="{{ route('services') }}"
                    wire:navigate.hover
                >
                    what I offer
                </flux:link>
                .
            </flux:text>

            <flux:text class="text-body">
                I can help with
                <flux:link
                    href="{{ route('services.laravel-php-contractor') }}"
                    wire:navigate.hover
                >
                    Laravel & PHP contracting
                </flux:link>
                ,
                <flux:link
                    href="{{ route('services.app-rescue') }}"
                    wire:navigate.hover
                >
                    app rescue
                </flux:link>
                or a
                <flux:link
                    href="{{ route('app-security-review') }}"
                    wire:navigate.hover
                >
                    fixed-price security review
                </flux:link>
                .
            </flux:text>

            <div class="flex flex-wrap gap-2">
                <flux:button
                    class="max-sm:w-full"
                    href="mailto:chris@mellor.pizza"
                    icon="mail"
                >
                    chris@mellor.pizza
                </flux:button>
                <flux:button
                    class="max-sm:w-full"
                    href="https://www.linkedin.com/in/chrismellor85"
                    icon="brand-linkedin"
                    target="_blank"
                >
                    LinkedIn
                </flux:button>
            </div>
        </x-page-head>

        <livewire:contact-form />

        <x-faq
            :items="$faqs"
            label="01"
        />
    </main>
</x-layout.main>
