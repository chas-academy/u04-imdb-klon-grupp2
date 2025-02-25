<x-layout class="px-0 sm:pt-18">
    <!-- Mobile View -->
    <x-cover-image
        :title="$movie->title"
        :id="$movie->id"
        :src="$movie->cover_image"
        class="h-64 w-full object-cover sm:hidden"
    />

    <div class="px-4 sm:hidden">
        <div class="flex justify-between pt-4">
            <div class="flex flex-col gap-4">
                <h1 class="text-2xl font-bold text-slate-50">
                    {!! $movie->title !!}
                </h1>
                <div class="flex flex-col gap-1">
                    <div class="flex items-center gap-2">
                        <x-rating
                            class="sm:hidden"
                            size="sm"
                            :rating="$movie->rating_average"
                        />
                        <div class="text-indigo-200">|</div>
                        <p>{!! $movie->year !!}</p>
                        <div class="text-indigo-200">|</div>
                        <p class="sm:hidden">
                            {!! $movie->duration !!}
                        </p>
                    </div>
                    <p class="text-xs font-bold text-slate-100">
                        {!! $movie->director !!}
                    </p>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach ($movie->genres as $genre)
                        <x-tag :label="$genre->name" link="" />
                    @endforeach
                </div>
            </div>
            <x-poster
                class="w-32"
                :id="$movie->id"
                :src="$movie->poster"
                alt="Poster of {{ $movie->title }}"
            />
        </div>
        <p class="pt-3">{!! $movie->description !!}</p>
        <x-button
            x-data
            @click="$dispatch('open-modal', 'add-to-list')"
            variant="primary"
            size="md"
            class="mt-6 w-full"
        >
            Add to list
        </x-button>
        @if ($isAdmin)
            <div class="mt-2 flex gap-2">
                <form
                    method="post"
                    action="{{ route('admin.movie.destroy', $movie->id) }}"
                >
                    @csrf
                    @method('delete')
                    <x-button
                        class="w-full bg-red-400"
                        variant="primary"
                        size="md"
                    >
                        Delete
                    </x-button>
                </form>

                <x-button
                    class="w-full"
                    variant="secondary"
                    size="md"
                    href="{{ route('admin.edit.movie', ['id' => $movie->id]) }}"
                >
                    Edit
                </x-button>
            </div>
        @endif
    </div>

    <!-- Desktop View -->
    <div class="hidden px-4 sm:block">
        <div class="flex items-center justify-between gap-4">
            <h1 class="w-150 text-2xl font-bold text-slate-50">
                {!! $movie->title !!}
            </h1>
            @if ($isAdmin)
                <div class="flex gap-2">
                    <form
                        method="post"
                        action="{{ route('admin.movie.destroy', $movie->id) }}"
                    >
                        @csrf
                        @method('delete')
                        <x-button
                            class="bg-red-400 hover:bg-red-500"
                            variant="primary"
                            size="md"
                        >
                            Delete
                        </x-button>
                    </form>
                    <x-button
                        class=""
                        variant="secondary"
                        size="md"
                        href="{{ route('admin.edit.movie', ['id' => $movie->id]) }}"
                    >
                        Edit
                    </x-button>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-2 pt-3">
            <x-rating size="sm" :rating="$movie->rating_average" />
            <div class="text-indigo-200">|</div>
            <p>{!! $movie->year !!}</p>
            <div class="text-indigo-200">|</div>
            <p class="">{!! $movie->duration !!}</p>
            <div class="text-indigo-200">|</div>
            <p class="text-xs font-bold text-slate-100">
                {!! $movie->director !!}
            </p>
        </div>

        <div class="flex gap-4 pt-3">
            <div class="flex w-70 flex-col gap-3">
                <x-poster
                    class="h-104 min-w-70"
                    :id="$movie->id"
                    :src="$movie->poster"
                    alt="Poster of {{ $movie->title }}"
                />
                <x-button
                    x-data="{ isLoggedIn: {{ auth()->check() ? 'true' : 'false' }} }"
                    @click="isLoggedIn ? $dispatch('open-modal', 'add-to-list') : window.location.href = '{{ route('login') }}'"
                    variant="primary"
                    size="md"
                >
                    Add to list
                </x-button>
            </div>
            <div class="flex flex-col gap-3">
                <x-cover-image
                    :title="$movie->title"
                    :id="$movie->id"
                    :src="$movie->cover_image"
                    class="h-104 w-182 rounded-xs object-cover"
                />
                <div class="flex flex-wrap gap-3">
                    @foreach ($movie->genres as $genre)
                        <x-tag :label="$genre->name" link="" />
                    @endforeach
                </div>
            </div>
        </div>
        <p class="max-w-144 pt-4 pb-3">
            {!! $movie->description !!}
        </p>
    </div>

    <div class="space-y-4 px-4 pt-12">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold">Reviews</h2>
            <x-button
                x-data
                @click="$dispatch('open-modal', 'create-review')"
                variant="secondary"
                size="sm"
            >
                Write a review
            </x-button>
        </div>
        @if ($reviews->isEmpty())
            <p class="pt-10 text-center text-slate-200">
                This movie does not have any reviews yet!
            </p>
        @else
            <x-section :columns="[1, 'sm' => 2]">
                @foreach ($reviews as $review)
                    <x-review
                        :id="$review->movie->id"
                        :image="$review->movie->poster"
                        :title="$review->movie->title"
                        :content="$review->content"
                        :rating="$review->rating"
                        :created_at="$review->created_at"
                        :username="$review->user->username"
                        link="{{ route('review', ['id' => $review->id]) }}"
                    />
                @endforeach
            </x-section>
        @endif
    </div>

    <x-modal.base name="add-to-list" :show="$errors->addToList->isNotEmpty()">
        <div
            class="mt-header-mobile sm:mt-header-desktop mx-4 flex w-full max-w-5xl flex-col gap-4"
        >
            <x-input.error
                :message="$errors->addToList->first()"
                class="relative text-lg"
            />
            @if ($userLists && $userLists->isNotEmpty())
                <x-section :columns="[2, 'sm' => 4, 'md' => 6]">
                    @foreach ($userLists as $list)
                        <div class="flex flex-col gap-2">
                            <x-list
                                :title="$list['title']"
                                :posters="$list['posters']->toArray()"
                                link="{{ route('list', ['id' => $list['id']]) }}"
                            />
                            <form
                                method="post"
                                action="{{ route('list.add-to-list', ['listId' => $list['id'], 'movieId' => $movie->id]) }}"
                            >
                                @csrf
                                @method('put')

                                <x-button class="w-full">Add to list</x-button>
                            </form>
                        </div>
                    @endforeach
                </x-section>
            @else
                <div
                    class="pointer-events-none relative flex flex-1 flex-col items-center justify-center gap-4"
                >
                    <p class="text-slate-200">You don't have a list yet!</p>
                    <x-button
                        x-data
                        @click="
                            $dispatch('close-modal', 'add-to-list')
                            $dispatch('open-modal', 'create-list')
                        "
                        class="pointer-events-auto"
                    >
                        Create list
                    </x-button>
                </div>
            @endif
        </div>
    </x-modal.base>

    <x-modal.base
        name="create-review"
        :show="$errors->createReview->isNotEmpty() || $errors->createReviewValidation->isNotEmpty()"
    >
        <x-modal.input>
            <x-slot:title>
                {{ $movie->title }}
            </x-slot>
            <form
                method="post"
                action="{{ route('review.store', ['id' => $movie->id, 'title' => $movie->title]) }}"
                class="flex flex-col gap-6"
            >
                @csrf
                <div class="flex flex-col gap-4">
                    <x-input.rating
                        name="rating"
                        :value="old('rating')"
                        required
                        :error="$errors->createReviewValidation->first('rating')"
                        label="Your rating"
                    />
                    <x-input.textarea
                        name="content"
                        :value="old('content')"
                        :error="$errors->createReviewValidation->first('content')"
                        label="Review"
                        placeholder="Let others know why they should (or shouldn't) watch this film."
                        color="light"
                    />
                </div>

                <x-input.error :message="$errors->createReview->first()" />

                <div class="flex gap-2">
                    <x-button
                        x-data
                        @click="$dispatch('close-modal', 'create-review')"
                        type="button"
                        variant="secondary"
                    >
                        Cancel
                    </x-button>
                    <x-button class="flex-1">Publish review</x-button>
                </div>
            </form>
        </x-modal.input>
    </x-modal.base>

    <x-create-list-modal />
</x-layout>
