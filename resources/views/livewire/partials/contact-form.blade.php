<x-form.form wire:submit="send">
    <div class="space-y-5">
        <div>
            <flux:input
                class="sm:w-1/2"
                type="text"
                aria-label="Name"
                placeholder="Name"
                wire:model.live.blur="contact_name"
            />
        </div>
        <div>
            <flux:input
                class="sm:w-1/2"
                type="email"
                aria-label="Email"
                placeholder="Email"
                wire:model.live.blur="contact_email"
            />
        </div>
        <div>
            <flux:textarea
                class="sm:w-1/2"
                aria-label="Message"
                placeholder="Tell me about your project, timeline, or what you’d like help with…"
                cols="30"
                rows="16"
                wire:model.live.blur="contact_message"
            ></flux:textarea>
        </div>

        <div class="flex w-full justify-end sm:w-1/2">
            <button
                class="button-pizza inline-flex items-center space-x-3"
                type="submit"
            >
                <svg
                    class="h-6 w-6"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    wire:loading.remove
                    wire:target="send"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"
                    />
                </svg>
                <svg
                    class="h-6 w-6 animate-spin text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    wire:loading
                    wire:target="send"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    ></circle>
                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                    ></path>
                </svg>
                <span
                    wire:loading.remove
                    wire:target="send"
                >
                    Send message
                </span>
                <span
                    wire:loading
                    wire:target="send"
                >
                    Sending message...
                </span>
            </button>
        </div>
    </div>
</x-form.form>
