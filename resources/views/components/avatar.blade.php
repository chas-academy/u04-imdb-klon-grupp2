@props([
    'size',
    'image' => null,
])

@php
    $sizes = [
        'size-6' => $size === 'sm',
        'size-12' => $size === 'md',
        'size-28' => $size === 'lg',
    ];
@endphp

@if (isset($image))
    <img
        src="{{ $image }}"
        @class(array_merge($sizes, ['rounded-full border-1 border-slate-50 object-cover']))
        {{ $attributes }}
    />
@else
    <x-lucide-circle-user-round @class($sizes) />
@endif
