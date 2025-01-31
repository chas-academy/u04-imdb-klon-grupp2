@props([
    'title',
    'posters',
])

@php
    $posters = array_pad($posters, 4, ['src' => null, 'alt' => null]);
    $posters = array_slice($posters, 0, 4);
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-col gap-2']) }}>
    <div class="grid grid-cols-2 overflow-hidden rounded-xs">
        @foreach ($posters as $poster)
            <x-poster
                :src="$poster['src']"
                :alt="$poster['alt']"
                :rounded="false"
            />
        @endforeach
    </div>
    <p class="font-bold">{{ $title }}</p>
</div>
