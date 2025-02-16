@props([
    'title',
    'rating',
    'image',
    'link',
    'id',
])

<a
    href="{{ $link }}"
    {{ $attributes->twMerge(['class' => 'flex cursor-pointer flex-col gap-2 transition hover:scale-102']) }}
>
    <x-poster :id="$id" :src="$image" alt="Poster for {{ $title }}" />
    <div class="flex flex-col gap-0.5">
        <p class="line-clamp-3 text-base/snug font-bold">{{ $title }}</p>
        <x-rating :rating="$rating" size="sm" />
    </div>
</a>
