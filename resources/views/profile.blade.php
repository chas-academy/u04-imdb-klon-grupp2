@php
    $title = $isCurrentUserProfile ? 'My reviews' : "$username's reviews";
@endphp

<x-layout>
    @if ($reviews->isNotEmpty())
        <div class="flex flex-col items-start gap-4">
            <x-section-header.link
                title="{!! $title !!}"
                href="{{ route('reviews.user', ['username' => $username]) }}"
            />
            <x-section :columns="[1, 'md' => 2]">
                @foreach ($reviews as $review)
                    <x-review
                        :title="$review->movie->title "
                        :content="$review->content"
                        :created_at="$review->created_at"
                        :rating="$review->rating"
                        :image="$review->movie->cover_image"
                        link="{{ route('review', ['id' => $review->id]) }}"
                    />
                @endforeach
            </x-section>
        </div>
    @endif
</x-layout>
