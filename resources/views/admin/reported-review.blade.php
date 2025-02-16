<x-layout>
    <div class="mt-12 flex flex-col">
        <x-section-header.back-link
            title="{{ $report->user->username . ' report' }}"
            href="{{ route('reported.reviews') }}"
            backLabel="Back to reported reviews"
        />

        <!-- Desktop Design -->
        <div class="flex flex-col justify-between md:flex-row">
            <div class="mt-4 w-full max-w-xl">
                <div class="flex w-full flex-col gap-4">
                    <x-review
                        :id="$report->review->movie->id"
                        :title="$report->review->movie->title"
                        :content="$report->review->content"
                        :image="$report->review->movie->poster"
                        :rating="$report->review->movie->rating_average"
                        created_at="{{ $report->review->movie->created_at->diffForHumans() }}"
                        link="{{ route('review', ['id' => $report->review->id]) }}"
                        class="grow"
                    />

                    <div class="gap-4 text-slate-400">
                        <div>
                            <p>
                                Reported at:
                                <span class="text-slate-50">
                                    {{ $report->created_at->diffForHumans() }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p>
                                <span class="text-slate-50">
                                    {{ "$report->reason" }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="mt-4 flex max-w-xl justify-start gap-2 md:flex-col lg:ml-auto lg:flex-row"
            >
                <form
                    method="POST"
                    action="{{ route('clear.review.report', $report->id) }}"
                >
                    @csrf
                    @method('PUT')
                    <x-button type="submit" variant="secondary" class="mb-auto">
                        Clear report
                    </x-button>
                </form>
                <div class="flex grow md:grow-0 lg:block">
                    <x-button
                        class="w-full bg-red-400 hover:bg-red-500 lg:w-auto"
                        x-data
                        @click="$dispatch('open-modal', 'delete-review')"
                    >
                        Delete review
                    </x-button>
                </div>
            </div>
        </div>

        {{--
            <div class="ml-auto flex justify-start gap-2">
            <form
            method="POST"
            action="{{ route('clear.review.report', $report->id) }}"
            >
            @csrf
            @method('PUT')
            <x-button type="submit" variant="secondary">
            Clear report
            </x-button>
            </form>
            <div>
            <x-button
            class="bg-red-400 hover:bg-red-500"
            x-data
            @click="$dispatch('open-modal', 'delete-review')"
            >
            Delete review
            </x-button>
            </div>
            </div>
        --}}

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
                        <x-button type="submit" class="flex-1">
                            Confirm
                        </x-button>
                    </div>
                </form>
            </x-modal.input>
        </x-modal.base>
    </div>
</x-layout>
