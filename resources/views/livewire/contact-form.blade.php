<div>
    <x-section
        title="Or send a message"
        label="Message"
    >
        <x-card>
            <x-form.form wire:submit="send">
                <div class="space-y-5">
                    <flux:input
                        type="text"
                        label="Name"
                        wire:model.live.blur="contact_name"
                    />
                    <flux:input
                        type="email"
                        label="Email"
                        wire:model.live.blur="contact_email"
                    />
                    <flux:textarea
                        label="Message"
                        placeholder="Tell me about your project, timeline, or what you’d like help with…"
                        rows="8"
                        wire:model.live.blur="contact_message"
                    />

                    <div class="flex justify-end">
                        <flux:button
                            class="max-sm:w-full"
                            type="submit"
                            variant="primary"
                            icon="send"
                        >
                            Send message
                        </flux:button>
                    </div>
                </div>
            </x-form.form>
        </x-card>
    </x-section>
</div>
