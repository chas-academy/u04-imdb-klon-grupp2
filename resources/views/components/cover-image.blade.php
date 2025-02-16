@props([
    'title',
    'id' => null,
])

<img
    alt="Cover image of {{ $title }}"
    src="{{ getFileUrl('/storage/movies/' . $id, $attributes->get('src')) }}"
    {{ $attributes->twMerge(['class' => '']) }}
/>
