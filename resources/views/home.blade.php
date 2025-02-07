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
    <x-input.rating rating="8" label="Rating:" />
</x-layout>
