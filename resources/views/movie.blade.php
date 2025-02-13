<x-layout>
    <!-- Mobile View -->
    <img
        src="{{ $movie->cover_image }}"
        alt="Cover image of {{ $movie->title }}"
        class="h-64 w-full object-cover sm:hidden"
    />
    <div class="flex justify-between pt-4 sm:hidden">
        <div class="flex flex-col gap-4 sm:hidden">
            <h1 class="text-2xl font-bold text-slate-50 sm:hidden">
                {{ $movie->title }}
            </h1>
            <div class="flex flex-col gap-1 sm:hidden">
                <div class="flex items-center gap-2 sm:hidden">
                    <x-rating
                        class="sm:hidden"
                        size="sm"
                        :rating="$movie->rating_average"
                    />
                    <div class="text-indigo-200 sm:hidden">|</div>
                    <p>{{ $movie->year }}</p>
                    <div class="text-indigo-200 sm:hidden">|</div>
                    <p class="sm:hidden">{{ $movie->duration }}</p>
                </div>
                <p class="text-xs font-bold text-slate-100 sm:hidden">
                    {{ $movie->director }}
                </p>
            </div>
            <div class="flex flex-wrap gap-2 sm:hidden">
                @foreach ($movie->genres as $genre)
                    <x-tag :label="$genre->name" link="" />
                @endforeach
            </div>
        </div>
        <x-poster class="w-32 sm:hidden" src="{{ $movie->poster }}" />
    </div>
    <div
        class="flex flex-col gap-3 sm:hidden"
        x-data="{ showFullText: false }"
    >
        <p :class="{ 'line-clamp-3': !showFullText }" class="pt-3 sm:hidden">
            {{ $movie->description }}
        </p>
        <button
            @click="showFullText = !showFullText"
            class="cursor-pointer text-end text-sm font-bold text-indigo-400 hover:underline focus:outline-none sm:hidden"
        >
            <span x-show="!showFullText">Show more</span>
            <span x-show="showFullText">Show less</span>
        </button>
    </div>

    <x-button class="mt-6 w-full sm:hidden" variant="primary" size="md" href="">
        Add to list
    </x-button>

    <x-button
        x-data
        @click="$dispatch('open-modal', 'create-review')"
        variant="secondary"
        size="sm"
    >
        Write a review
    </x-button>

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
            href=""
        >
            Edit
        </x-button>
    </div>
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
                        @click="$dispatch('close-modal', 'create-list')"
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
