<x-layout>
    <div class="m-auto flex items-center justify-between">
        <x-profile-simplified
            :username="'@'. auth()->user()->username"
            :image="auth()->user()->image"
            size="md"
        />
        <div class="flex gap-2">
            <x-button
                variant="secondary"
                size="sm"
                href="{{ route('admin.create.user') }}"
            >
                Create user
            </x-button>
            <x-button
                variant="primary"
                size="sm"
                href="{{ route('admin.create.movie') }}"
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
</x-layout>
