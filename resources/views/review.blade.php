@php
    $formattedDate = formatDate($review->created_at);
    $backLabel = request('from') === 'movie' ? 'Back to movie' : (request('from') === 'profile' ? 'Back to profile' : 'Back');
    $backHref = url()->previous();
@endphp

<x-layout>
    <x-section-header.back-link
        title="{{ $review->movie->title }}"
        extraLabel="Review"
        href="{{ $backHref }}"
        backLabel="{{ $backLabel }}"
    />
    <div class="relative mt-3 flex items-center gap-4">
        <x-poster class="w-32 sm:w-40" src="{{ $review->movie->cover_image}}" />
        <x-lucide-ellipsis-vertical
            class="absolute top-0 right-0 size-6 cursor-pointer text-slate-50 sm:-top-10"
        />

        <div class="flex w-full flex-col gap-3">
            <x-rating size="lg" rating="{{ $review->movie->rating_average }}" />

            <div
                class="flex items-center justify-between sm:flex-col sm:items-start sm:gap-1"
            >
                <x-profile-simplified
                    username="{{ $review->user->username }}"
                    image="{{ $review->user->image }}"
                    size="sm"
                />
                <p class="text-xs text-slate-400">{{ $formattedDate }}</p>
            </div>
        </div>
    </div>
    <p class="mt-6 max-w-xl text-base/snug text-slate-100">
        {{ $review->content }}
    </p>
</x-layout>
