@props([
    'label',
    'link'
])

<a href="{{ $link }}" class="transition bg-slate-700 hover:bg-slate-600 rounded text-slate-100 font-bold sm:px-4 sm:py-2 px-2.5 py-0.5 inline-flex justify-center items-center text-sm sm:text-base self-start">
    {{ $label }}
</a>
