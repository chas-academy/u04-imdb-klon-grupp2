@props([
    'title',
    'extraLabel' => null,
    'href',
    'backLabel',
])
<div>
    <a href="{{ $href }}" class="group flex flex-col">
        <div class="flex items-center gap-2">
            <x-lucide-move-left
                class="size-6 text-indigo-200 group-hover:text-indigo-300"
            />
            <span class="text-base text-slate-200 group-hover:text-indigo-300">
                {{ $backLabel }}
            </span>
        </div>
    </a>
    <div class="flex gap-1">
        <h1 class="text-2xl font-bold text-slate-50">
            {{ $title }}
        </h1>
        <span class="text-xs text-indigo-400">{{ $extraLabel }}</span>
    </div>
</div>
