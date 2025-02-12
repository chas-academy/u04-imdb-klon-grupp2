<x-layout>
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
