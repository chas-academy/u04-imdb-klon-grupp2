@php
    $title = $isCurrentUserProfile ? 'My reviews' : "$username's reviews";
@endphp

<x-layout class="pt-6 sm:pt-10">
    <x-section-header.back-link
        href="{{ route('profile', ['username' => $username]) }}"
        :title="$title"
        backLabel="Back to profile"
    />

    <div class="grid grid-cols-1 gap-4 pt-4 sm:grid-cols-2">
        @foreach ($reviews as $review)
            <x-review
                :id="$review->movie->id"
                :title="$review->movie->title"
                :content="$review->content"
                :rating="$review->rating"
                :image="$review->movie->poster"
                :created_at="$review->created_at"
                :username="$isCurrentUserProfile ? null : $username"
                link="{{ route('review', ['id' => $review->id]) }}"
            />
        @endforeach
    </div>
</x-layout>
