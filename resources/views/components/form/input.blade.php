@props([
    'for',
])

<input
    value="{{ old($for, $slot ?? '') }}"
    {{ $attributes->merge(['id' => $for, 'name' => $for])->class(['w-full', 'mt-2.5', 'form-pizza' => ! $errors->has($for), 'form-pizza-error' => $errors->has($for)]) }}
/>

@error($for)
    <p class="mt-2.5 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
@enderror
