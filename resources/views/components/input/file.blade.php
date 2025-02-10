@props([
    'name',
    'label',
    'placeholder',
    'value' => null,
    'error',
])
<div {{ $attributes->class('flex flex-col gap-1') }}>
    <x-input.label for="{{ $name }}">
        {{ $label }}
    </x-input.label>
    <x-button size="sm" class="w-32">Click me</x-button>
    <input
        type="file"
        id="avatar"
        name="avatar"
        accept="image/png, image/jpeg"
    />
    <x-input.error message="{{ $error }}" />
</div>
