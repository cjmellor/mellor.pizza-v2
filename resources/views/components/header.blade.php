<header class="print:hidden">
    <div class="flex h-16 flex-col items-center justify-around space-y-8 sm:mx-20 md:flex-row md:space-y-0">
        <div class="w-full lg:w-5/12 xl:w-1/3">
            <a href="{{ route('homepage') }}">
                <h2 class="font-anton text-pizza dark:text-pizza-dark text-center text-6xl tracking-wider uppercase drop-shadow-lg md:text-left md:text-5xl">Chris.Mellor</h2>
            </a>
        </div>
        <div class="font-roboto-mono flex w-full flex-col items-center justify-evenly space-y-6 px-6 tracking-wider uppercase md:flex-row md:items-center md:space-y-0 md:px-0 md:text-xl lg:w-7/12 xl:w-2/3">
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
