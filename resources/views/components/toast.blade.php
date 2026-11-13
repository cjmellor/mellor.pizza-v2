<div
    class="relative z-10 flex justify-center"
    x-data="toast"
>
    <div
        class="absolute w-1/2 rounded-b-md bg-green-100 py-4 text-center text-green-800 shadow-xl motion-reduce:translate-none"
        :class="{ 'text-red-800! bg-red-100!': type === 'error' }"
        {{ $attributes }}
        x-cloak
        x-on:send-toast.window="sendEventData"
        x-ref="type"
        x-show="show"
        x-transition:enter="transition duration-400 ease-[ease]"
        x-transition:enter-start="-translate-y-full opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition duration-200 ease-(--ease-out-strong)"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="-translate-y-full opacity-0"
    >
        <x-progress-circle
            class="absolute right-0 mr-6 cursor-pointer"
            animationSpeed="5s"
            height="h-6"
            lineColor="text-green-800"
            strokeWidth="3"
            trackColor="text-green-800/50"
            width="w-6"
            x-on:click="close"
        />
        <span x-text="message"></span>
    </div>
</div>

<script
    async
    defer
>
    document.addEventListener('alpine:init', () => {
        Alpine.data('toast', () => ({
            show: false,
            message: '',
            type: 'success',

            close() {
                this.show = false;
            },

            sendEventData(event) {
                this.show = true;
                this.message = event.detail.messageContent;
                this.type = event.detail.type;

                setTimeout(() => {
                    this.close();
                }, 5000);
            },
        }));
    });
</script>
