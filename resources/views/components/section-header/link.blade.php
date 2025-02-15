@props([
    'title',
    'extraLabel',
    'href',
])

<div class="w-fit">
    @isset($extraLabel)
        <span class="text-sm text-indigo-400">{{ $extraLabel }}</span>
    @endisset

    <a href="{{ $href }}" class="group flex flex-col">
        <div class="flex items-center gap-2">
            <h2 class="text-xl font-bold text-slate-50">
                {{ $title }}
            </h2>
            <x-lucide-move-right
                class="size-6 text-indigo-200 transition-all ease-out group-hover:ml-1 group-hover:text-indigo-400"
            />
        </div>
    </a>
</div>
