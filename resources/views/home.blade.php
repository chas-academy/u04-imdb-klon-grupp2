<x-layout>
    <div class="flex flex-col gap-4">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($topRatedMovies->take(3) as $movie)
                <a
                    href="{{ route('movie', ['id' => $movie->id, 'title' => $movie->title]) }}"
                    class="transition hover:scale-101 nth-[2]:hidden nth-[3]:hidden sm:nth-[2]:block md:nth-[3]:block"
                >
                    <x-poster src="{{ $movie->poster }}" class="size-full" />
                </a>
            @endforeach
        </div>
        <x-section :columns="[4, 'lg' => 6]" scrollableOnMobile>
            @foreach ($topRatedMovies->skip(1) as $movie)
                <a
                    href="{{ route('movie', ['id' => $movie->id, 'title' => $movie->title]) }}"
                    class="transition hover:scale-101 sm:nth-[1]:hidden sm:nth-[n+6]:hidden md:nth-[2]:hidden md:nth-[n+6]:block md:nth-[n+7]:hidden lg:nth-[n+7]:block lg:nth-[n+9]:hidden"
                >
                    <x-poster src="{{ $movie->poster }}" class="size-full" />
                </a>
            @endforeach
        </x-section>
    </div>
    <div class="flex gap-4">
        <x-movie
            title="The Worst Person in The World"
            rating="7.6"
            image="https://m.media-amazon.com/images/M/MV5BZGEyYzBiYmItZDM4OC00NTdmLWJlYzctODdiM2E2MjZmYTU2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
            link=""
            class="w-40"
        />
        <x-movie
            title="The Worst Person in The World hello here is some more text to see how it looks"
            rating="7.6"
            image="https://m.media-amazon.com/images/M/MV5BZGEyYzBiYmItZDM4OC00NTdmLWJlYzctODdiM2E2MjZmYTU2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
            link=""
            class="w-40"
        />
    </div>
    <div class="flex gap-4">
        <x-movie
            title="The Worst Person in The World"
            rating="7.6"
            image="https://m.media-amazon.com/images/M/MV5BZGEyYzBiYmItZDM4OC00NTdmLWJlYzctODdiM2E2MjZmYTU2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
            link=""
            class="w-40"
        />
        <x-movie
            title="The Worst Person in The World hello here is some more text to see how it looks"
            rating="7.6"
            image="https://m.media-amazon.com/images/M/MV5BZGEyYzBiYmItZDM4OC00NTdmLWJlYzctODdiM2E2MjZmYTU2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
            link=""
            class="w-40"
        />
    </div>
    <div class="flex gap-4">
        <x-movie
            title="The Worst Person in The World"
            rating="7.6"
            image="https://m.media-amazon.com/images/M/MV5BZGEyYzBiYmItZDM4OC00NTdmLWJlYzctODdiM2E2MjZmYTU2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
            link=""
            class="w-40"
        />
        <x-movie
            title="The Worst Person in The World hello here is some more text to see how it looks"
            rating="7.6"
            image="https://m.media-amazon.com/images/M/MV5BZGEyYzBiYmItZDM4OC00NTdmLWJlYzctODdiM2E2MjZmYTU2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
            link=""
            class="w-40"
        />
    </div>
    <div class="flex gap-4">
        <x-movie
            title="The Worst Person in The World"
            rating="7.6"
            image="https://m.media-amazon.com/images/M/MV5BZGEyYzBiYmItZDM4OC00NTdmLWJlYzctODdiM2E2MjZmYTU2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
            link=""
            class="w-40"
        />
        <x-movie
            title="The Worst Person in The World hello here is some more text to see how it looks"
            rating="7.6"
            image="https://m.media-amazon.com/images/M/MV5BZGEyYzBiYmItZDM4OC00NTdmLWJlYzctODdiM2E2MjZmYTU2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
            link=""
            class="w-40"
        />
        </x-layout>
    </div>