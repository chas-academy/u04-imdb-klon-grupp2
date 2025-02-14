@props([
    'name',
    'label',
    'value' => null,
    'error',
    'color' => 'dark',
])

<div
    {{ $attributes->class('flex flex-col gap-1 ') }}
    x-data
>
    <x-input.label for="{{ $name }}">
        {{ $label }}
    </x-input.label>
    <div
        @class([
            'bg-slate-700' => $color === 'dark',
            'bg-slate-600' => $color === 'light',
            'flex h-10 rounded-full px-3 py-2',
        ])
    >
        <button
            @click.prevent="$refs.datepicker.showPicker()"
            class="rounded-xs px-1"
        >
            <x-lucide-calendar class="size-4 text-slate-50" />
        </button>
        <input
            type="date"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $value }}"
            x-ref="datepicker"
            class="hide-calendar-picker-indicator flex-1 rounded-xs px-1 text-base text-slate-50 placeholder:text-slate-400"
        />
    </div>
    <x-input.error message="{{ $error }}" />
</div>
