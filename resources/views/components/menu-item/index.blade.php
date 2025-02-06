{{--
    A reusable Blade component for defining custom link variants within a menu.
    Supports "default," "highlights," and "destructive" styles.
    
    Example Usage:
    <nav>
    <ul class="flex flex-col">
    <li><x-menu-item href="/" label="Edit" /></li>
    <li><x-menu-item href="/" label="Change visibility" /></li>
    <li><x-menu-item href="/" label="Delete" variant="destructive" /></li>
    <li><x-menu-item label="Cancel" variant="highlights" /></li>
    </ul>
    </nav>
--}}

@props([
    'label',
    'variant' => 'default',
    'href' => '#',
])

@php
    $baseClasses = 'block rounded-lg px-4 py-2 text-center transition-all duration-200 ease-out';
    $hoverClasses = 'cursor-pointer hover:bg-slate-600 focus:bg-slate-600 focus:outline-0';

    $variantClasses = match ($variant) {
        'highlights' => 'font-bold text-indigo-400',
        'destructive' => 'text-red-400',
        default => 'text-slate-200',
    };
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "$baseClasses $variantClasses $hoverClasses"]) }}
>
    {{ $label }}
</a>
