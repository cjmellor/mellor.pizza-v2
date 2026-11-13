<div
    class="dark:bg-dark-focus dark:border-dark-line-lighter sticky bottom-0 z-10 h-screen w-full max-w-full border border-b-0 border-gray-300 bg-white p-8 text-gray-500 shadow-2xl backdrop-blur-none sm:h-168 sm:rounded-t-3xl"
    @slideUp()
    x-data="{
        showContactMePopUp: @entangle('showContactMePopUp').live,
    }"
    x-show="showContactMePopUp"
    x-on:click.away="showContactMePopUp = false"
    x-on:show-contact.window="showContactMePopUp = ! showContactMePopUp"
    x-cloak
>
    {{-- Same button for different screen sizes --}}
    <div
        class="absolute top-1 right-1 flex sm:top-4 sm:right-4 sm:hidden"
        wire:click="closePopUp"
    >
        <flux:icon.x-mark
            class="text-pizza size-5"
            variant="solid"
        />
    </div>

    <div
        class="contact-close group hover:bg-pizza/90 dark:hover:bg-pizza-dark/75 hidden items-center justify-center sm:flex"
        wire:click="closePopUp"
    >
        <flux:icon.x-mark
            class="text-pizza size-5 group-hover:text-white"
            variant="solid"
        />
    </div>
    {{-- End --}}

    <flux:heading
        class="font-merriweather mb-3"
        size="xl"
    >
        How can I help?
    </flux:heading>

    @include('livewire.partials.contact-form')
</div>
