<header class="print:hidden">
    <div class="flex h-16 flex-col items-center justify-around space-y-8 sm:mx-20 lg:flex-row lg:space-y-0">
        <div class="w-auto max-w-full lg:w-5/12 xl:w-1/3">
            <a href="{{ route('homepage') }}">
                <h2
                    class="font-anton text-pizza dark:text-pizza-dark text-center text-6xl tracking-wider uppercase drop-shadow-lg min-[820px]:text-[4.25rem] md:text-left md:text-5xl"
                >
                    Chris.Mellor
                </h2>
            </a>
        </div>
        <div
            class="font-roboto-mono flex w-auto max-w-full flex-col items-center space-y-4 px-6 text-lg tracking-wider uppercase min-[744px]:w-full min-[744px]:flex-row min-[744px]:flex-wrap min-[744px]:justify-center min-[744px]:space-y-0 min-[744px]:gap-x-6 min-[744px]:gap-y-4 min-[744px]:px-0 min-[744px]:tracking-normal md:text-xl lg:w-7/12 lg:flex-nowrap lg:justify-evenly lg:px-0 xl:w-2/3 landscape:w-full landscape:flex-row landscape:flex-wrap landscape:justify-center landscape:space-y-0 landscape:gap-x-6 landscape:gap-y-4"
        >
            <div>
                <x-link
                    to="{{ route('articles') }}"
                    wire:navigate.hover
                >
                    Articles
                </x-link>
            </div>
            <div>
                <x-link
                    to="{{ route('cv') }}"
                    wire:navigate.hover
                >
                    View CV
                </x-link>
            </div>
            <div>
                <x-link
                    to="{{ route('portfolio') }}"
                    wire:navigate.hover
                >
                    Portfolio
                </x-link>
            </div>
            <div>
                <x-link
                    x-data
                    x-on:click.prevent="$dispatch('show-contact')"
                >
                    Contact.Me
                </x-link>
            </div>
        </div>
    </div>
</header>
