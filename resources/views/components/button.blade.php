@props(['variant' => 'primary', 'size' => 'md', 'type' => 'button'])

@php
    $classes = [
        'rounded-full bg-indigo-400 text-slate-50 hover:bg-indigo-500' => $variant === 'primary',
        'rounded-full border-2 border-slate-100 text-slate-100 hover:border-indigo-400 hover:text-indigo-400' => $variant === 'secondary',
        'rounded-sm bg-transparent p-1 hover:bg-slate-700' => $variant === 'icon',
        'px-6 py-2 text-base' => $size === 'md' && $variant !== 'icon',
        'px-3 py-1 text-xs' => $size === 'sm' && $variant !== 'icon',
        'inline-flex cursor-pointer items-center justify-center font-bold whitespace-nowrap transition',
    ];
@endphp

@if ($type === 'button')
    <button {{ $attributes->class($classes) }}>
        {{ $slot }}
    </button>
@elseif ($type === 'link')
    <a {{ $attributes->class($classes) }}>{{ $slot }}</a>
@endif
