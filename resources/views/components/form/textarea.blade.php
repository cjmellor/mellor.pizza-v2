@props([
    'for',
])

<textarea
    class="@if ($errors->has($for)) form-pizza-error @else form-pizza @endif mt-2.5 w-full sm:w-1/2"
    {{ $attributes->merge(['id' => $for, 'name' => $for]) }}
>
    {{ old($for, $slot ?? '') }}
</textarea>

@error($for)
    <p class="mt-2.5 text-sm text-red-500">{{ $message }}</p>
@enderror
