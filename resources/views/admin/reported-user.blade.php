<x-layout>
    <x-section-header.back-link
        title="Reported user"
        href="{{ route('admin.dashboard') }}"
        backLabel="Back to dashboard"
    />
    <div>
        @foreach ($reports as $report)
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
                        <form
                            method="POST"
                            action="{{ route('admin.ban.user', $report->user->id) }}"
                        >
                            <x-button type="submit" class="bg-red-400">
                                Ban user
                            </x-button>
                        </form>
                    </div>
                </div>
                <div class="mt- text-sm text-slate-400">
                    <p>
                        Reported reason:
                        <span class="text-slate-50">
                            {{ "$report->reason" }}
                        </span>
                    </p>
                    <p>
                        Reported at:
                        <span class="text-slate-50">
                            {{ $report->created_at->diffForHumans() }}
                        </span>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
