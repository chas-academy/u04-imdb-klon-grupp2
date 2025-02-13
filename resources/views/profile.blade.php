@php
    $listsTitle = $isCurrentUserProfile ? 'My lists' : "$username's lists";
    $reviewsTitle = $isCurrentUserProfile ? 'My reviews' : "$username's reviews";
@endphp

<x-layout>
    @if ($lists->isNotEmpty())
        <div class="flex flex-col items-start gap-4">
            <x-section-header.link
                :title="$listsTitle"
                href="{{ route('lists', ['username' => $username]) }}"
            />
            <x-section :columns="[2, 'md' => 4]">
                @foreach ($lists as $list)
                    <x-list
                        :title="$list['title']"
                        :posters="$list['posters']->toArray()"
                        link="{{ route('list', ['id' => $list['id']]) }}"
                    />
                @endforeach
            </x-section>
        </div>
    @endif

    @if ($reviews->isNotEmpty())
        <div class="flex flex-col items-start gap-4">
            <x-section-header.link
                :title="$reviewsTitle"
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
