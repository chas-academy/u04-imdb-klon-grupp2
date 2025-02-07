@props([
    'title',
    'extraLabel',
])

<div class="flex gap-1">
    <h1 class="text-2xl font-bold text-slate-50">{{ $title }}</h1>
    @if ($extraLabel)
        <span class="text-xs text-indigo-400">{{ $extraLabel }}</span>
    @endif
</div>
