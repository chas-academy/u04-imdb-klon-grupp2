<x-layout>
    <div
        class="m-auto flex flex-col items-center justify-between gap-4 sm:flex-row sm:gap-0"
    >
        <div class="sm:flex-1 sm:self-start">
            <x-profile-simplified
                :username="auth()->user()->username"
                :image="auth()->user()->image"
                size="md"
            />
        </div>

        <div
            class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row sm:justify-end sm:space-x-2"
        >
            <x-button
                variant="secondary"
                href="{{ route('admin.create.user') }}"
                class="w-full px-6 py-2 text-base sm:w-auto sm:px-3 sm:py-1 sm:text-xs"
            >
                Create user
            </x-button>
            <x-button
                variant="primary"
                href="{{ route('admin.create.movie') }}"
                class="w-full px-6 py-2 text-base sm:w-auto sm:px-3 sm:py-1 sm:text-xs"
            >
                Create movie
            </x-button>
        </div>
    </div>

    <div class="mt-8">
        <x-section-header.link
            title="All users"
            href="{{ route('admin.users') }}"
        />
    </div>

    <div class="mt-12">
        <div class="mb-4">
            <x-section-header.no-link
                title="Latest uploaded movies"
                extraLabel="movies"
            />
        </div>
        <x-section :columns="[3, 'sm' => 4, 'lg' => 6]" scrollableOnMobile>
            @foreach ($latestUploadedMovies as $movie)
                <x-movie
                    :id="$movie->id"
                    :title="$movie->title"
                    :image="$movie->poster"
                    :rating="$movie->rating_average"
                    :link="route('movie', ['id' => $movie->id, 'title' => $movie->title])"
                    class="sm:nth-[n+5]:hidden lg:nth-[n+5]:block lg:nth-[n+7]:hidden"
                />
            @endforeach
        </x-section>
    </div>

    <div class="mt-12 grid grid-cols-1 gap-12 md:grid-cols-2">
        <div>
            <x-section-header.link
                title="Reported users"
                :extraLabel="'Pending: (' . $reportedUsers->count() . ')'"
                href="{{ route('reported.users') }}"
            />
            <div class="mt-4 space-y-4">
                @foreach ($reportedUsers->take(7) as $reportedUser)
                    <div class="flex items-center justify-between">
                        <x-profile-simplified
                            :username="$reportedUser->user->username"
                            :image="$reportedUser->user->image"
                            size="md"
                        />
                        <x-button
                            variant="secondary"
                            size="sm"
                            href="{{ route('reported.user', ['username' => $reportedUser->user->username]) }}"
                        >
                            Check
                            {{ $reportsByUser[$reportedUser->user_id] > 1 ? $reportsByUser[$reportedUser->user_id] . ' reports' : 'report' }}
                        </x-button>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <x-section-header.link
                title="Reported reviews"
                :extraLabel="'Pending: (' . $reportedReviews->count() . ')'"
                href="{{ route('reported.reviews') }}"
            />
            <div class="mt-4 space-y-4">
                @foreach ($reportedReviews->take(3) as $userReview)
                    <x-review.reported
                        :title="$userReview->review->movie->title"
                        :content="$userReview->review->content"
                        :id="$userReview->review->movie->id"
                        :image="$userReview->review->movie->poster"
                        :username="$userReview->user->username"
                        :link="route('reported.review', ['id' => $userReview->id])"
                    />
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
