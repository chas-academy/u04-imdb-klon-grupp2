<x-layout class="px-0 sm:pt-18">
    <!-- Mobile View -->
    <img
        src="{{ $movie->cover_image }}"
        alt="Cover image of {{ $movie->title }}"
        class="h-64 w-full object-cover sm:hidden"
    />
    <div class="px-4">
        <div class="flex justify-between pt-4 sm:hidden">
            <div class="flex flex-col gap-4 sm:hidden">
                <h1 class="text-2xl font-bold text-slate-50 sm:hidden">
                    {!! $movie->title !!}
                </h1>
                <div class="flex flex-col gap-1 sm:hidden">
                    <div class="flex items-center gap-2 sm:hidden">
                        <x-rating
                            class="sm:hidden"
                            size="sm"
                            :rating="$movie->rating_average"
                        />
                        <div class="text-indigo-200 sm:hidden">|</div>
                        <p>{!! $movie->year !!}</p>
                        <div class="text-indigo-200 sm:hidden">|</div>
                        <p class="sm:hidden">
                            {!! $movie->duration !!}
                        </p>
                    </div>
                    <p class="text-xs font-bold text-slate-100 sm:hidden">
                        {!! $movie->director !!}
                    </p>
                </div>
                <div class="flex flex-wrap gap-2 sm:hidden">
                    @foreach ($movie->genres as $genre)
                        <x-tag :label="$genre->name" link="" />
                    @endforeach
                </div>
            </div>
            <x-poster
                class="w-32 sm:hidden"
                :id="$movie->id"
                :src="$movie->poster"
                alt="Poster of {{ $movie->title }}"
            />
        </div>
        <p class="pt-3 sm:hidden">{!! $movie->description !!}</p>
        <x-button
            class="mt-6 w-full sm:hidden"
            variant="primary"
            size="md"
            href=""
        >
            Add to list
        </x-button>
        @if ($isAdmin)
            <div class="mt-2 flex gap-2 sm:hidden">
                <x-button
                    class="w-full bg-red-400 sm:hidden"
                    variant="primary"
                    size="md"
                    href=""
                >
                    Delete
                </x-button>
                <x-button
                    class="w-full sm:hidden"
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
                    <x-button
                        class="bg-red-400 hover:bg-red-500"
                        variant="primary"
                        size="md"
                        href=""
                    >
                        Delete
                    </x-button>
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
                <x-button variant="primary" size="md" href="">
                    Add to list
                </x-button>
            </div>
            <div class="flex flex-col gap-3">
                <x-cover-image
                    :title="$movie->title"
                    :id="$movie->id"
                    :src="$movie->cover_image"
                />
                <div class="flex flex-wrap gap-3">
                    @foreach ($movie->genres as $genre)
                        <x-tag :label="$genre->name" link="" />
                    @endforeach
                </div>
            </div>
        </div>
        <p class="max-w-144 pt-3">
            {!! $movie->description !!}
        </p>
    </div>

    <x-button
        x-data
        @click="$dispatch('open-modal', 'create-review')"
        variant="secondary"
        size="sm"
    >
        Write a review
    </x-button>
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
</x-layout>
