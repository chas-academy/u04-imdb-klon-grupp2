@props([
    'variant' => 'default',
    'href' => null,
])

@php
    $baseClasses = 'block w-full cursor-pointer rounded-lg px-4 py-2 text-center transition-all duration-200 ease-out';
    $hoverClasses = 'hover:bg-slate-600';

    $variantClasses = match ($variant) {
        'highlights' => 'font-bold text-indigo-400',
        'destructive' => 'text-red-400',
        default => 'text-slate-200',
    };
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        {{ $attributes->twMerge(['class' => "$baseClasses $variantClasses $hoverClasses"]) }}
    >
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->twMerge(['class' => "$baseClasses $variantClasses $hoverClasses"]) }}
    >
        {{ $slot }}
    </button>
@endif
