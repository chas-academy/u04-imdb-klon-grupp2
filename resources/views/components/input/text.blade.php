@props([
    'name',
    'placeholder',
])

<div {{ $attributes->class('flex flex-col gap-1') }}>
    <x-input.label for="{{ $name }}">test</x-input.label>
    <input
        type="text"
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        class="rounded-full bg-slate-700 px-4 py-2 text-base text-slate-50 placeholder:text-slate-400"
    />
</div>
