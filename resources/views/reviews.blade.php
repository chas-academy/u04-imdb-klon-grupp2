<x-layout>
    <x-section-header.back-link
        href=""
        title="My reviews"
        backLabel="Back to profile"
    />

    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
        @foreach ($reviews as $review)
            <x-review
                :title="$review->movie->title"
                :description="$review->content"
                rating="{{ $review->rating }}"
                image="{{ $review->movie->cover_image }}"
                username="{{ $review->user->username }}"
                link="{{ route('review', ['id' => $review->id]) }}"
                created_at="{{ $review->created_at }}"
            />
        @endforeach
    </div>
</x-layout>
