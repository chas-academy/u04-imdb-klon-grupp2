@props([
    'title',
    'posters',
    'link',
])

@php
    $posters = array_pad($posters, 4, ['src' => null, 'title' => null]);
    $posters = array_slice($posters, 0, 4);
@endphp

<a
    href="{{ $link }}"
    {{ $attributes->merge(['class' => 'flex cursor-pointer flex-col gap-2 transition hover:scale-102']) }}
>
    <div class="grid grid-cols-2 overflow-hidden rounded-xs">
        @foreach ($posters as $poster)
            <x-poster
                :src="$poster['src']"
                alt="Poster for {{ $poster['title'] }}"
                :rounded="false"
            />
        @endforeach
    </div>
    <p class="line-clamp-3 text-base/snug font-bold">{{ $title }}</p>
</a>
