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
            x-data
            @click="$dispatch('open-modal', 'review-menu')"
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

    <x-modal.base
        name="review-menu"
        :show="$errors->deleteReview->isNotEmpty()"
    >
        <x-modal.menu :error="$errors->deleteReview->first()">
            <x-slot:title>
                @if ($isAuthor)
                    <p class="font-normal">
                        Review of
                        <span class="font-bold">
                            {{ $review->movie->title }}
                        </span>
                    </p>
                @else
                    <p class="font-normal">
                        <span class="font-bold">
                            {{ $review->user->username }}'s
                        </span>
                        review of
                        <span class="font-bold">
                            {{ $review->movie->title }}
                        </span>
                    </p>
                @endif
            </x-slot>

            @if (! $isAuthor)
                {{-- TODO: open report review modal --}}
                <x-menu-item>Report</x-menu-item>
                <x-modal.divider />
            @endif

            @if ($isAuthor)
                {{-- TODO: open edit review modal --}}
                <x-menu-item>Edit</x-menu-item>
                <x-modal.divider />
            @endif

            @if ($isAuthor || auth()->user()->role === 'admin')
                <form
                    method="post"
                    action="{{ route('review.destroy', ['id' => $review->id]) }}"
                >
                    @csrf
                    @method('delete')
                    <x-menu-item variant="destructive">Delete</x-menu-item>
                </form>
                <x-modal.divider />
            @endif

            <x-menu-item
                x-data
                @click="$dispatch('close-modal', 'review-menu')"
                variant="highlights"
            >
                Cancel
            </x-menu-item>
        </x-modal.menu>
    </x-modal.base>
</x-layout>
