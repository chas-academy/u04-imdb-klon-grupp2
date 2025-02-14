<x-layout>
    <x-section-header.back-link
        title="Reported review"
        href="{{ route('admin.dashboard') }}"
        backLabel="Back to dashboard"
    />
    <div>
        <div class="my-4 flex flex-col gap-2">
            <div class="flex items-center justify-between gap-4">
                <x-profile-simplified
                    :username="$report->user->username"
                    :image=" $report->user->image"
                    size="md"
                />
                <div class="ml-auto flex gap-2">
                    <form
                        method="POST"
                        action="{{ route('clear.report', $report->id) }}"
                    >
                        @csrf
                        @method('DELETE')
                        <x-button type="submit" variant="secondary">
                            Clear report
                        </x-button>
                    </form>
                    <x-button
                        class="bg-red-400"
                        x-data
                        @click="$dispatch('open-modal', 'ban-user')"
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
            <div class="mt- text-sm text-slate-400">
                <p>
                    Reported reason:
                    <span class="text-slate-50">{{ "$report->reason" }}</span>
                </p>
                <p>
                    Reported at:
                    <span class="text-slate-50">
                        {{-- {{ $report->created_at->diffForHumans() }} --}}
                    </span>
                </p>
            </div>
        </div>

        <x-review
            :title="$report->review->movie->title"
            :content="$report->review->content"
            :image="$report->review->movie->poster"
            :rating="$report->review->movie->rating_average"
            created_at="{{ $report->review->movie->created_at->diffForHumans() }}"
            link="{{ route('movie', ['id' => $report->review->movie->id, 'title' => $report->review->movie->title]) }}"
        />
    </div>

    {{--
        <x-modal.base
        name="ban-user"
        :show="$errors->banUser->isNotEmpty() || $errors->banUserValidation->isNotEmpty()"
        >
        <x-modal.input>
        <x-slot:title>
        {{ $report->user->username }}
        </x-slot>
        
        <form
        method="post"
        action="{{ route('profile.ban', ['id' => $report->user->id]) }}"
        class="flex flex-col gap-6"
        >
        @csrf
        @method('put')
        
        <div class="flex flex-col gap-4">
        <x-input.date
        name="date"
        :value="old('date')"
        required
        :error="$errors->banUserValidation->first('date')"
        label="Until when should this user be banned?"
        color="light"
        />
        </div>
        
        <x-input.error :message="$errors->banUser->first()" />
        
        <div class="flex gap-2">
        <x-button
        x-data
        @click="$dispatch('close-modal', 'ban-user')"
        type="button"
        variant="secondary"
        >
        Cancel
        </x-button>
        <x-button class="flex-1">Save</x-button>
        </div>
        </form>
        </x-modal.input>
        </x-modal.base>
    --}}
</x-layout>
