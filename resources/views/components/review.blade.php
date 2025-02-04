@props([
    'title',
    'description',
    'created_at',
    'rating',
    'image',
    'link',
    'username' => null,
])

@php
    $formattedDate = formatDate($created_at);
@endphp

<a
    {{ $attributes->class('pointer flex max-w-sm cursor-pointer rounded-sm bg-slate-700 p-2 transition hover:scale-102') }}
    href="{{ $link }}"
>
    <x-poster :src="$image" class="w-28" alt="Image for {{ $title }}" />

    <div class="ml-3 flex flex-col">
        <div class="flex items-start justify-between gap-2">
            <h2 class="text-lg font-bold text-slate-50">
                {{ $title }}
            </h2>
            <x-rating :rating="$rating" size="md" />
        </div>

        <p class="line-clamp-3 text-slate-300">{{ $description }}</p>

        <div class="mt-auto flex justify-between">
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
