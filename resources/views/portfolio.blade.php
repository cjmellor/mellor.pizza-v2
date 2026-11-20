<x-layout.main :schema="[App\Seo\Seo::webPage('CollectionPage', 'portfolio')]">
    <main>
        <x-page-head
            title="My portfolio"
            label=""
        >
            <flux:text class="lede">
                Client Laravel and PHP work, including PoweredByRental, App-Hive and 16Personalities, plus two things of my own: Glowbreak,
                a browser game, and Kandu, a product I'm building. More coming soon.
            </flux:text>
        </x-page-head>

        <x-section
            title="Building"
            label="01"
        >
            <x-project-card
                href="https://glowbreak.mellor.pizza"
                heading="Glowbreak"
                subheading="glowbreak.mellor.pizza"
                badge="Live"
            >
                <x-slot:cover>
                    <picture>
                        <source
                            type="image/avif"
                            srcset="/images/portfolio/glowbreak.avif"
                        />
                        <source
                            type="image/webp"
                            srcset="/images/portfolio/glowbreak.webp"
                        />
                        <img
                            class="size-full object-cover object-top"
                            src="/images/portfolio/glowbreak.jpg"
                            alt=""
                            width="960"
                            height="504"
                            loading="lazy"
                        />
                    </picture>
                </x-slot>
                <x-slot:icon>
                    <img
                        class="size-full object-cover"
                        src="/images/portfolio/glowbreak-icon.jpg"
                        alt=""
                        width="128"
                        height="128"
                    />
                </x-slot>

                A neon brick breaker that runs in the browser on a phone or computer. I built it with Laravel and Phaser. Players compete in
                leagues, and Reverb updates the standings live.
            </x-project-card>

            <x-project-card
                heading="Kandu"
                subheading="Laravel side project"
                badge="In progress"
            >
                <x-slot:cover>
                    <div
                        class="absolute inset-0 bg-[radial-gradient(70%_160%_at_75%_0%,color-mix(in_oklab,var(--color-brand)_32%,transparent),transparent_65%)]"
                    ></div>
                    <div class="absolute top-8 -right-6 -left-6 grid origin-top-left -rotate-3 grid-cols-7 gap-3">
                        @foreach ([3, 2, 3, 2, 3, 2, 1] as $column => $tickets)
                            <div class="flex flex-col gap-2">
                                @for ($ticket = 0; $ticket < $tickets; $ticket++)
                                    <i
                                        @class([
                                            'relative h-7.5 rounded-md border before:absolute before:top-[13px] before:left-2.5 before:h-1 before:w-[55%] before:rounded-full',
                                            'border-brand/60 bg-brand/30 before:bg-ink/35' => $column === 3 && $ticket === 0,
                                            'border-ink/10 bg-ink/6 before:bg-ink/12' => ! ($column === 3 && $ticket === 0),
                                        ])
                                    ></i>
                                @endfor
                            </div>
                        @endforeach
                    </div>
                </x-slot>
                <x-slot:icon>
                    <flux:icon.kanban class="size-7" />
                </x-slot>

                A kanban tracker taking its cues from 37signals’ Fizzy: boards, cards and columns, kept deliberately simple.
            </x-project-card>
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
            button="Get in touch"
        >
            {{-- format-ignore-start --}}
            Got a brief in mind or want to chat through an idea? I’m open to freelance and contract opportunities. See
            <flux:link href="{{ route('services') }}" wire:navigate.hover>what I offer</flux:link>.
            {{-- format-ignore-end --}}
        </x-contact-band>
    </main>
</x-layout.main>
