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
            <div class="space-y-2">
                <flux:heading level="3">{{ $item['question'] }}</flux:heading>
                <flux:text class="copy">{{ $item['answer'] }}</flux:text>
            </div>
        @endforeach
    </div>
</x-section>
