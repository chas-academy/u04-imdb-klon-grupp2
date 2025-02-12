@php
    $formattedDate = formatDate($review->created_at);
    $backLabel = request('from') === 'movie' ? 'Back to movie' : (request('from') === 'profile' ? 'Back to profile' : 'Back');
    $backHref = url()->previous();
@endphp

<x-layout class="pt-1 sm:pt-10">
    <div class="flex items-start justify-between gap-6">
        <x-section-header.back-link
            :title="$review->movie->title"
            extraLabel="Review"
            href="{{ $backHref }}"
            backLabel="{{ $backLabel }}"
        />
        <x-button
            variant="icon"
            srLabel="Open review menu"
            class="hidden sm:block"
        >
            <x-lucide-ellipsis-vertical class="size-6 text-slate-50" />
        </x-button>
    </div>
    <div class="relative mt-3 flex items-center gap-4">
        <x-poster
            class="w-32 sm:w-40"
            src="{{ $review->movie->cover_image }}"
        />
        <x-button
            variant="icon"
            srLabel="Open review menu"
            class="absolute top-0 right-0 block sm:hidden"
        >
            <x-lucide-ellipsis-vertical
                class="size-6 text-slate-50 sm:hidden"
            />
        </x-button>

        <div class="flex w-full flex-col gap-3">
            <x-rating size="lg" :rating="$review->rating" />

            <div
                class="flex flex-wrap items-center justify-between gap-2 sm:flex-col sm:items-start"
            >
                <x-profile-simplified
                    :username="$review->user->username"
                    :image="$review->user->image"
                    size="sm"
                />
                <p class="text-xs text-slate-400">{{ $formattedDate }}</p>
            </div>
        </div>
    </div>
    <p class="mt-6 max-w-xl text-slate-100">
        {!! $review->content !!}
    </p>
</x-layout>
