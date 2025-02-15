<x-layout>
    <x-section-header.back-link
        title="Reported review"
        href="{{ route('admin.dashboard') }}"
        backLabel="Back to dashboard"
    />
    <div>
        <div class="my-4 flex flex-col gap-2">
            <div class="flex items-center justify-between gap-4">
                <x-profile.simplified
                    :username="$report->user->username"
                    :image=" $report->user->image"
                    size="md"
                />
                <div class="ml-auto flex gap-2">
                    <form
                        method="POST"
                        action="{{ route('clear.review.report', $report->id) }}"
                    >
                        @csrf
                        @method('PUT')
                        <x-button
                            type="submit"
                            class="px-2 py-1 text-sm sm:px-4 sm:py-2 sm:text-base md:px-6 md:py-3 md:text-lg"
                            variant="secondary"
                        >
                            Clear report
                        </x-button>
                    </form>
                    <x-button
                        class="bg-red-400 px-2 py-1 text-sm hover:bg-red-500 sm:px-4 sm:py-2 sm:text-base md:px-6 md:py-3 md:text-lg"
                        x-data
                        @click="$dispatch('open-modal', 'delete-review')"
                    >
                        Delete review
                    </x-button>
                </div>

                {{--
                    @click="
                    $dispatch('close-modal', 'reported-review')
                    $dispatch('open-modal', 'report-user')
                    "
                --}}
            </div>

            <div class="flex max-w-xl flex-col gap-4 text-sm text-slate-400">
                <x-review
                    :id="$report->review->movie->id"
                    :title="$report->review->movie->title"
                    :content="$report->review->content"
                    :image="$report->review->movie->poster"
                    :rating="$report->review->movie->rating_average"
                    created_at="{{ $report->review->movie->created_at->diffForHumans() }}"
                    link="{{ route('movie', ['id' => $report->review->movie->id, 'title' => $report->review->movie->title]) }}"
                />

                <p>
                    Reported at:
                    <span class="text-slate-50">
                        {{ $report->created_at->diffForHumans() }}
                    </span>
                </p>
                <p>
                    Reported reason:
                    <span class="text-slate-50">{{ "$report->reason" }}</span>
                </p>
            </div>
        </div>
    </div>

    <x-modal.base
        name="delete-review"
        :show="$errors->banUser->isNotEmpty() || $errors->banUserValidation->isNotEmpty()"
    >
        <x-modal.input>
            <x-slot:title>
                Are you sure you want to delete this review?
            </x-slot>

            <form
                method="POST"
                action="{{ route('delete.review', $report->id) }}"
                class="flex flex-col gap-6"
            >
                @csrf
                @method('DELETE')

                <div class="flex gap-2">
                    <x-button
                        x-data
                        @click="$dispatch('close-modal', 'delete-review')"
                        type="button"
                        variant="secondary"
                    >
                        Cancel
                    </x-button>
                    <x-button type="submit" class="flex-1">Confirm</x-button>
                </div>
            </form>
        </x-modal.input>
    </x-modal.base>
</x-layout>
