@props([
    'title',
    'id' => null,
])

<img
    alt="Cover image of {{ $title }}"
    src="{{ getFileUrl('/storage/movies/' . $id, $attributes->get('src')) }}"
    class="h-104 w-182 rounded-xs object-cover"
/>
