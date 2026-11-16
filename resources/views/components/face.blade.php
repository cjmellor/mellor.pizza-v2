<div class="relative p-4">
    <picture
        class="short:size-32 nav:size-48 block size-44 rounded-full shadow-[0_0_0_1px_color-mix(in_oklab,var(--color-brand)_60%,transparent),0_0_0_12px_color-mix(in_oklab,var(--color-brand)_10%,transparent),0_24px_56px_-12px_color-mix(in_oklab,var(--color-brand)_55%,transparent)] lg:size-56"
    >
        <source
            type="image/avif"
            srcset="{{ asset('images/faces/avatar-face-448.avif') }}"
        />
        <source
            type="image/webp"
            srcset="{{ asset('images/faces/avatar-face-448.webp') }}"
        />
        <img
            class="size-full rounded-full bg-white object-cover object-top grayscale dark:sepia"
            src="{{ asset('images/faces/avatar-face-448.jpg') }}"
            alt="Chris Mellor"
            height="224"
            width="224"
        />
    </picture>
</div>
