@props([
    'title',
    'content',
    'image',
    'username',
    'link',
    'id',
])

<a
    {{ $attributes->class('flex gap-3 rounded-sm bg-slate-700 p-2 transition hover:scale-101') }}
    href="{{ $link }}"
>
    <x-poster
        :id="$id"
        :src="$image"
        class="w-20"
        alt="Poster for {{ $title }}"
    />

    <div class="flex flex-1 flex-col gap-1">
        <div class="flex-1 space-y-1">
            <h2 class="text-lg font-bold text-slate-50">
                {{ $title }}
            </h2>
            <p class="line-clamp-2 text-slate-300">{{ $content }}</p>
        </div>

        <div class="flex items-center justify-between">
            <p class="text-base text-slate-50">
                {{ $username }}
            </p>
            <x-button variant="secondary" size="sm">Check report</x-button>
        </div>
    </div>
</a>
