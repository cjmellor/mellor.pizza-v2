<div class="relative -z-10 flex h-48 w-48 lg:h-56 lg:w-56">
    <div class="dark:bg-dark absolute z-10 flex h-full w-full items-center justify-center rounded-full bg-white"></div>
    <div class="bg-pizza dark:bg-pizza-dark absolute h-full w-full rounded-full blur-xl"></div>
    <div class="bg-pizza dark:bg-pizza-dark absolute h-full w-full animate-pulse rounded-full opacity-60 blur-2xl"></div>
    <div class="bg-pizza dark:bg-pizza-dark absolute -inset-0.5 rounded-full"></div>
    <div class="absolute z-10 rounded-full">
        <picture>
            <source
                type="image/avif"
                srcset="{{ asset('storage/faces/avatar-face.avif') }}"
            />
            <source
                type="image/webp"
                srcset="{{ asset('storage/faces/avatar-face.webp') }}"
            />
            <img
                class="h-48 w-48 rounded-full grayscale lg:h-56 lg:w-56 dark:sepia"
                src="{{ asset('storage/faces/avatar-face.png') }}"
                alt="It's me!"
                height="192"
                width="192"
            />
        </picture>
    </div>
</div>
