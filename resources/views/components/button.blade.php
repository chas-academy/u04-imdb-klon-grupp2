@props(['variant' => 'primary', 'size' => 'md', 'type' => 'button', 'srLabel' => null])

@php
    if ($variant === 'icon' && ! isset($srLabel)) {
        throw new Exception('an icon button must have a screen reader label');
    }

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
        @isset($srLabel)
            <span class="sr-only">
                {{ $srLabel }}
            </span>
        @endisset

        {{ $slot }}
    </button>
@elseif ($type === 'link')
    <a {{ $attributes->class($classes) }}>
        @isset($srLabel)
            <span class="sr-only">
                {{ $srLabel }}
            </span>
        @endisset

        {{ $slot }}
    </a>
@endif
