@props([
    'rounded' => true,
    'id' => null,
])

@if (! $attributes->get('src'))
    <div
        {{ $attributes->class(['rounded-xs' => $rounded, 'flex aspect-2/3 items-center justify-center bg-slate-700']) }}
    >
        <x-lucide-clapperboard class="size-6 text-slate-500" />
    </div>
@else
    <img
        src="{{ getFileUrl('/storage/movies/' . $id, $attributes->get('src')) }}"
        {{ $attributes->class(['rounded-xs' => $rounded, 'aspect-2/3 object-cover']) }}
    />
@endif
