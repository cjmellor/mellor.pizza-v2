<x-layout.main :schema="[App\Seo\Seo::webPage('ContactPage', 'contact')]">
    <main>
        <x-page-head
            title="Tell me what you're building"
            label="05 — Contact"
        >
            <x-availability dot />

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
    </main>
</x-layout.main>
