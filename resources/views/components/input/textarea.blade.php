@props([
    'name',
    'label',
    'placeholder',
    'value' => null,
    'error',
    'color' => 'dark',
])

<div {{ $attributes->class('flex flex-col gap-1') }}>
    <x-input.label for="{{ $name }}">
        {{ $label }}
    </x-input.label>
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        rows="4"
        @class([
            'bg-slate-700' => $color === 'dark',
            'bg-slate-600' => $color === 'light',
            'resize-none rounded-lg px-4 py-2 text-base text-slate-50 placeholder:text-slate-400',
        ])
    >
        {{ $value }}
    </textarea>
    <x-input.error message="{{ $error }}" />
</div>
