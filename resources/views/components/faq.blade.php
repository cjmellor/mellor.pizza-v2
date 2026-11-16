@props([
    'items',
    'label',
])

<x-section
    title="Frequently asked questions"
    :$label
>
    <div class="space-y-6">
        @foreach ($items as $item)
            <div class="border-brand/40 space-y-2 border-l-2 pl-4">
                <flux:heading
                    class="text-ink screen:font-bold"
                    level="3"
                    size="lg"
                >
                    {{ $item['question'] }}
                </flux:heading>
                <flux:text class="text-body text-[15px]/[1.7]">{{ $item['answer'] }}</flux:text>
            </div>
        @endforeach
    </div>
</x-section>
