@props([
    'label',
    'link',
])

<a
    href="{{ $link }}"
    class="inline-flex items-center justify-center self-start rounded bg-slate-700 px-2.5 py-0.5 text-sm font-bold text-slate-100 transition hover:bg-slate-600 sm:px-4 sm:py-2 sm:text-base"
>
    {{ $label }}
</a>
