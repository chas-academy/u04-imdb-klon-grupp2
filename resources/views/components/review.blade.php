@props([
    'title',
    'description',
    'created_at',
    'rating',
    'image',
    'link',
    'username' => null,
])

<a
    {{ $attributes->class('pointer flex max-w-sm cursor-pointer rounded-lg bg-slate-700 p-2 text-white shadow-lg transition hover:scale-102') }}
    href="{{ $link }}"
>
    <x-poster alt="Image for {{ $title }}" :src="$image" class="w-28" />

    <div class="ml-4 flex flex-col gap-2">
        <div class="flex items-start gap-2">
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

            <p class="text-xs text-slate-400">
                {{ $created_at }}
            </p>
        </div>
    </div>
</a>
