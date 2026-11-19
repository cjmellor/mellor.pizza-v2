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
                class="max-w-xl"
                heading="Kandu"
                subheading="Kanban project tracker"
                icon="kanban"
            >
                <x-slot:actions>
                    <flux:badge
                        size="sm"
                        color="amber"
                    >
                        In progress
                    </flux:badge>
                </x-slot>

                A kanban project tracker built with Laravel, inspired by Fizzy. In development.
            </x-card>
        </x-section>

        <x-section
            title="Client projects"
            label="02"
        >
            <ul
                class="grid gap-4 sm:grid-cols-2"
                role="list"
            >
                @foreach (\App\Portfolio\Project::all()->reverse() as $project)
                    <li class="flex">
                        <x-card
                            class="flex-1"
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

            <flux:text class="text-body">
                Need something similar, or help with an app that was built in a hurry? See
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
                or the
                <flux:link
                    href="{{ route('app-security-review') }}"
                    wire:navigate.hover
                >
                    app security review
                </flux:link>
                .
            </flux:text>
        </x-section>

        <x-contact-band
            title="Let’s work together"
            label="03"
            button="Contact me"
        >
            Got a brief in mind or want to chat through an idea? I’m open to freelance and contract opportunities. See
            <flux:link
                href="{{ route('services') }}"
                wire:navigate.hover
            >
                what I offer
            </flux:link>
            .
        </x-contact-band>
    </main>
</x-layout.main>
