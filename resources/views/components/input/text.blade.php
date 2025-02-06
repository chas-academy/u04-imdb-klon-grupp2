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
    <input
        type="text"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        class="rounded-full bg-slate-700 px-4 py-2 text-base text-slate-50 placeholder:text-slate-400"
    />
    <x-input.error message="{{ $error }}" />
</div>
