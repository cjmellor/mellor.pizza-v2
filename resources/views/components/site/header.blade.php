<header
    class="border-line bg-canvas/88 sticky top-0 z-20 border-b backdrop-blur-[10px] print:hidden"
    x-data="{ open: false }"
    x-on:keydown.escape.window="open = false"
>
    <nav
        class="flex flex-wrap items-stretch"
        aria-label="Main"
    >
        <a
            class="font-anton text-brand short:min-h-14 short:text-2xl nav:min-h-18 nav:px-8 nav:text-4xl flex min-h-16 flex-1 items-center px-5 text-[28px] leading-none tracking-[0.06em] uppercase sm:px-6 lg:px-6 xl:px-8"
            href="{{ route('homepage') }}"
            wire:navigate.hover
        >
            Chris.Mellor
        </a>

        <x-site.nav-items />

        <button
            class="border-line font-roboto-mono text-ink hover:bg-brand/6 focus-visible:outline-brand short:min-h-14 nav:hidden flex min-h-16 cursor-pointer items-center justify-center gap-2 border-l px-5 text-xs tracking-[0.08em] uppercase focus-visible:outline-2 focus-visible:-outline-offset-2"
            type="button"
            aria-controls="site-menu"
            x-bind:aria-expanded="open"
            x-bind:aria-label="open ? 'Close menu' : 'Open menu'"
            x-on:click="open = ! open"
        >
            <span x-text="open ? 'Close' : 'Menu'">Menu</span>
            <flux:icon.menu
                class="size-5"
                x-show="! open"
            />
            <flux:icon.x
                class="size-5"
                x-show="open"
                x-cloak
            />
        </button>
    </nav>

    <div
        class="border-line animate-menu-in short:max-h-[calc(100vh-56px)] nav:hidden flex max-h-[calc(100vh-64px)] flex-col overflow-y-auto border-t motion-reduce:animate-none"
        id="site-menu"
        x-show="open"
        x-on:click="open = false"
        x-cloak
    >
        <x-site.nav-items menu />
    </div>
</header>
