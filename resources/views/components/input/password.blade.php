@props([
    'name',
    'label',
    'placeholder',
])

<div
    {{ $attributes->class('flex flex-col gap-1') }}
    x-data="{
        hidden: true,
    }"
>
    <x-input.label for="{{ $name }}">
        {{ $label }}
    </x-input.label>
    <div class="flex h-10 gap-1 rounded-full bg-slate-700 px-3 py-2">
        <input
            :type="hidden ? 'password' : 'text'"
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            class="flex-1 rounded-xs px-1 text-base text-slate-50 placeholder:text-slate-400"
        />

        <x-button
            x-show="hidden"
            @click="hidden = !hidden"
            variant="icon"
            srLabel="Show password"
            type="button"
        >
            <x-lucide-eye class="size-6 text-slate-400" />
        </x-button>
        <x-button
            x-show="!hidden"
            @click="hidden = !hidden"
            variant="icon"
            srLabel="Hide password"
            type="button"
        >
            <x-lucide-eye-off class="size-6 text-slate-400" />
        </x-button>
    </div>
</div>
