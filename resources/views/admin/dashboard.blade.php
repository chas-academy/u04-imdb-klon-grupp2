<x-layout>
    <div
        class="m-auto flex flex-col items-center justify-between gap-4 sm:flex-row sm:gap-0"
    >
        <div class="sm:flex-1 sm:self-start">
            <x-profile-simplified
                :username="'@'. auth()->user()->username"
                :image="auth()->user()->image"
                size="md"
            />
        </div>

        <div
            class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row sm:justify-end sm:space-x-2"
        >
            <x-button
                variant="secondary"
                size="sm"
                href="{{ route('admin.create.user') }}"
                class="w-full sm:w-auto"
            >
                Create user
            </x-button>
            <x-button
                variant="primary"
                size="sm"
                href="{{ route('admin.create.movie') }}"
                class="w-full sm:w-auto"
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
                :extraLabel="'Pending: (' . $pendingReportedUsers . ')'"
                href="{{ route('reports.user') }}"
            />
            <div class="mt-4 space-y-4">
                @foreach ($reportedUsers as $reportedUser)
                    <div class="flex items-center justify-between">
                        <x-profile-simplified
                            :username="$reportedUser->user->username"
                            :image="$reportedUser->user->image"
                            size="md"
                        />
                        <x-button
                            variant="secondary"
                            size="sm"
                            :link="route('reports.show', ['id' => $reportedUser->user->id])"
                        >
                            Check report
                        </x-button>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <x-section-header.link
                title="Reported reviews"
                :extraLabel="'Pending: (' . $pendingReportedReviews . ')'"
                href="{{ route('reports.review') }}"
            />
            <div class="mt-4 space-y-4">
                @foreach ($reportedReviews as $userReview)
                    <x-review.reported
                        :title="$userReview->review->movie->title"
                        :content="$userReview->review->content"
                        :image="$userReview->review->movie->poster"
                        :username="$userReview->user->username"
                        :link="route('reports.show', ['id' => $userReview->id])"
                    />
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
