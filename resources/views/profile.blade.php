@php
    $listsTitle = $isCurrentUserProfile ? 'My lists' : "$user->username's lists";
    $reviewsTitle = $isCurrentUserProfile
        ? 'My reviews'
        : "$user->username's reviews";
@endphp

<x-layout class="flex flex-col gap-16 pt-6">
    <x-profile :user="$user" :statistics="$statistics">
        @if (auth()->check() && auth()->user()->role === 'admin' && $isCurrentUserProfile)
            <x-slot:buttons>
                <x-button
                    variant="secondary"
                    size="sm"
                    href="{{ route('admin.dashboard') }}"
                >
                    Go to admin dashboard
                </x-button>
            </x-slot>
        @endif
    </x-profile>

    <div class="flex flex-col gap-12">
        @if ($lists->isNotEmpty())
            <div class="flex flex-col items-start gap-4">
                <x-section-header.link
                    :title="$listsTitle"
                    href="{{ route('lists', ['username' => $user->username]) }}"
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
                    href="{{ route('reviews.user', ['username' => $user->username]) }}"
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
    </div>
</x-layout>
