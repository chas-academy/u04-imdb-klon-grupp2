<x-layout>
    <div class="my-4">
        <x-section-header.back-link
            backLabel="Back to dashboard"
            title="Reported reviews"
            href="{{ route('admin.dashboard') }}"
        />
    </div>
    <div class="mt-4 grid gap-4 space-y-4 sm:grid-cols-1 md:grid-cols-2">
        @foreach ($reports as $report)
            <x-review.reported
                :id="$report->review->movie->id"
                :title="$report->review->movie->title"
                :content="$report->review->content"
                :image="$report->review->movie->poster"
                :username="$report->user->username"
                :link="route('reported.review', ['id' => $report->id])"
            />
        @endforeach
    </div>
</x-layout>
