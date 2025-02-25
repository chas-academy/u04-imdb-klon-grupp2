@props([
    'title',
    'content',
    'created_at',
    'rating',
    'image',
    'link',
    'id',
    'username' => null,
])

@php
    $formattedDate = formatDate($created_at);
@endphp

<a
    {{ $attributes->class('flex min-h-36 gap-3 rounded-sm bg-slate-700 p-2 transition hover:scale-101') }}
    href="{{ $link }}"
>
    <x-poster
        :id="$id"
        :src="$image"
        class="w-28"
        alt="Poster for {{ $title }}"
    />

    <div class="flex flex-1 flex-col gap-2">
        <div class="flex-1 space-y-1">
            <div class="flex justify-between gap-2">
                <h2 class="text-lg font-bold text-slate-50">
                    {{ $title }}
                </h2>
                <x-rating :rating="$rating" size="md" />
            </div>

            <p class="line-clamp-3 text-slate-300">{{ $content }}</p>
        </div>

        <div class="flex justify-between">
            @if ($username)
                <p class="text-xs text-slate-50">
                    {{ $username }}
                </p>
            @endif

            <p class="ml-auto text-xs text-slate-400">
                {{ $formattedDate }}
            </p>
        </div>
    </div>
</a>
