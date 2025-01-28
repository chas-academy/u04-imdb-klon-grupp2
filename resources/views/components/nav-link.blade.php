@props([
    'active',
])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center border-b-2 border-indigo-400 px-1 pt-1 text-sm leading-5 font-medium text-gray-900 transition duration-150 ease-in-out focus:border-indigo-700 focus:outline-hidden'
            : 'inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm leading-5 font-medium text-gray-500 transition duration-150 ease-in-out hover:border-gray-300 hover:text-gray-700 focus:border-gray-300 focus:text-gray-700 focus:outline-hidden';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
