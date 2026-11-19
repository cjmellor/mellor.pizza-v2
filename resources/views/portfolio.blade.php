<x-layout.main :schema="[App\Seo\Seo::webPage('CollectionPage', 'portfolio')]">
    <main>
        <x-page-head
            title="My portfolio"
            label="02 — Portfolio"
        >
            <flux:text class="lede">
                Client Laravel and PHP work, including PoweredByRental, App-Hive and 16Personalities, plus Kandu, a product I'm building.
                More coming soon.
            </flux:text>
        </x-page-head>

        <x-section
            title="Building"
            label="01"
        >
            <x-card
                heading="Kandu"
                subheading="Kanban project tracker"
                icon="kanban"
            >
                <x-slot:actions>
                    <flux:badge
                        class="bg-brand/12! text-brand-ink! inset-ring-brand/25 inset-ring"
                        size="sm"
                        rounded
                    >
                        In progress
                    </flux:badge>
                </x-slot>

                Built with Laravel, taking its cues from 37signals’ Fizzy: boards, cards and columns, kept deliberately simple
            </x-card>
        </x-section>

        <x-section
            title="Client projects"
            label="02"
        >
            <ul
                class="gap-4 sm:columns-2 [&_[data-flux-card-heading]]:text-base/6 [&_[data-flux-card-heading]]:font-bold"
                role="list"
            >
                @foreach (\App\Portfolio\Project::all()->reverse() as $project)
                    <li class="mb-4 break-inside-avoid">
                        <x-card
                            :heading="$project->name"
                            :subheading="$project->url ?: null"
                            :logo="$project->logo"
                            :href="$project->url ? 'https://' . $project->url : null"
                        >
                            {!! $project->description !!}

                            @if ($project->testimonial)
                                <x-slot:footer>
                                    <p class="italic">“{{ $project->testimonial }}”</p>
                                </x-slot>
                            @endif
                        </x-card>
                    </li>
                @endforeach
            </ul>

            {{-- format-ignore-start --}}
            <flux:text class="text-body">
                Need something similar, or help with an app that was built in a hurry? See
                <flux:link href="{{ route('services.laravel-php-contractor') }}" wire:navigate.hover>Laravel & PHP contracting</flux:link>,
                <flux:link href="{{ route('services.app-rescue') }}" wire:navigate.hover>app rescue</flux:link>
                or the
                <flux:link href="{{ route('app-security-review') }}" wire:navigate.hover>app security review</flux:link>.
            </flux:text>
            {{-- format-ignore-end --}}
        </x-section>

        <x-contact-band
            title="Let’s work together"
            label="03"
            button="Contact me"
        >
            {{-- format-ignore-start --}}
            Got a brief in mind or want to chat through an idea? I’m open to freelance and contract opportunities. See
            <flux:link href="{{ route('services') }}" wire:navigate.hover>what I offer</flux:link>.
            {{-- format-ignore-end --}}
        </x-contact-band>
    </main>
</x-layout.main>
