@props(['rounded' => true])

<img
    {{ $attributes->class(['rounded-xs' => $rounded, 'aspect-2/3 object-cover']) }}
/>
