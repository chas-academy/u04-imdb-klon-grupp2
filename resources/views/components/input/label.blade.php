@props([
    'for',
])

<label for="{{ $for }}" class="px-2 text-base font-bold text-slate-100">
    {{ $slot }}
</label>
