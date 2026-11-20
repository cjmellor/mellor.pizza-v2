@props([
    'items',
    'label',
])

<x-section
    title="What do people usually ask?"
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
                <flux:text
                    class="text-body text-[15px]/[1.7] [&_a]:font-medium [&_a]:text-(--color-accent-content) [&_a]:underline [&_a]:decoration-(--color-accent-content)/20 [&_a]:underline-offset-[6px] [&_a]:hover:decoration-current"
                >
                    {!! Str::inlineMarkdown($item['answer'], ['html_input' => 'escape']) !!}
                </flux:text>
            </div>
        @endforeach
    </div>
</x-section>
