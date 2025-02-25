<x-layout>
    <div class="flex flex-col gap-4">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($topRatedMovies->take(3) as $movie)
                <a
                    href="{{ route('movie', ['id' => $movie->id, 'title' => $movie->title]) }}"
                    class="transition hover:scale-101 nth-[2]:hidden nth-[3]:hidden sm:nth-[2]:block md:nth-[3]:block"
                >
                    <x-poster
                        :id="$movie->id"
                        :src="$movie->poster"
                        class="size-full"
                    />
                </a>
            @endforeach
        </div>
        <x-section :columns="[4, 'lg' => 6]" scrollableOnMobile>
            @foreach ($topRatedMovies->skip(1) as $movie)
                <a
                    href="{{ route('movie', ['id' => $movie->id, 'title' => $movie->title]) }}"
                    class="transition hover:scale-101 sm:nth-[1]:hidden sm:nth-[n+6]:hidden md:nth-[2]:hidden md:nth-[n+6]:block md:nth-[n+7]:hidden lg:nth-[n+7]:block lg:nth-[n+9]:hidden"
                >
                    <x-poster
                        :id="$movie->id"
                        src="{{ $movie->poster }}"
                        class="size-full"
                    />
                </a>
            @endforeach
        </x-section>
    </div>
    @auth
        <div class="mt-16 mb-4">
            <x-section-header.link
                title="My Lists"
                href=" {{ route('lists', ['username' => auth()->user()->username])}}"
            />
        </div>

        @if ($myLists->isEmpty())
            <x-empty-state
                content="Looks like your list section is empty. Time to add your favorites!"
            />
        @else
            <x-section :columns="[3, 'sm' => 4, 'lg' => 6]" scrollableOnMobile>
                @foreach ($myLists as $list)
                    <x-list
                        :title="$list['title']"
                        :posters="$list['posters']->toArray()"
                        :link="route('list', ['id' => $list['id']])"
                        class="sm:nth-[n+5]:hidden lg:nth-[n+5]:flex lg:nth-[n+7]:hidden"
                    />
                @endforeach
            </x-section>

            @if ($latestCreatedList)
                <div class="mt-16 mb-4">
                    <x-section-header.link
                        :title="$latestCreatedList->title"
                        extraLabel="From your collection"
                        href=" {{route('list', ['id' => $latestCreatedList->id])}}"
                    />
                </div>
                @if ($latestCreatedList->movies->isEmpty())
                    <x-empty-state
                        content="Nothing here yet! Pick a movie and start building your collection."
                    />
                @else
                    <x-section
                        :columns="[3, 'sm' => 4, 'lg' => 6]"
                        scrollableOnMobile
                    >
                        @foreach ($latestCreatedList->movies->take(10) as $movie)
                            <x-movie
                                :id="$movie->id"
                                :title="$movie->title"
                                :image="$movie->poster"
                                :rating="$movie->rating_average"
                                class="sm:nth-[n+5]:hidden lg:nth-[n+5]:flex lg:nth-[n+7]:hidden"
                                :link="route('movie', ['id' => $movie->id, 'title' => $movie->title])"
                            />
                        @endforeach
                    </x-section>
                @endif
            @endif
        @endif
        @if ($latestUpdatedList)
            <div class="mt-16 mb-4">
                <x-section-header.link
                    :title="$latestUpdatedList->title"
                    extraLabel="Recently updated"
                    href="{{ route('list', ['id' => $latestUpdatedList->id]) }}"
                />
            </div>

            @if ($latestUpdatedList->movies->isEmpty())
                <x-empty-state
                    content="Nothing here yet! Pick a movie and start building your collection."
                />
            @else
                <x-section
                    :columns="[3, 'sm' => 4, 'lg' => 6]"
                    scrollableOnMobile
                >
                    @foreach ($latestUpdatedList->movies->take(10) as $movie)
                        <x-movie
                            :id="$movie->id"
                            :title="$movie->title"
                            :image="$movie->poster"
                            :rating="$movie->rating_average"
                            class="sm:nth-[n+5]:hidden lg:nth-[n+5]:flex lg:nth-[n+7]:hidden"
                            :link="route('movie', ['id' => $movie->id, 'title' => $movie->title])"
                        />
                    @endforeach
                </x-section>
            @endif
        @endif
    @endauth

    <div class="mt-16">
        <div class="mb-4">
            <x-section-header.no-link
                title="Movies & Popcorn—The Perfect Pair!"
                extraLabel="Movies"
            />
        </div>
        <x-section :columns="[3, 'sm' => 4, 'lg' => 6]">
            @foreach ($latestMovies as $movie)
                <x-movie
                    :id="$movie->id"
                    :title="$movie->title"
                    :image="$movie->poster"
                    :rating="$movie->rating_average"
                    :link="route('movie', ['id' => $movie->id, 'title' => $movie->title])"
                />
            @endforeach
        </x-section>
    </div>
</x-layout>
