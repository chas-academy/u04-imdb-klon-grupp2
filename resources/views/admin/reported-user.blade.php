<x-layout>
    <x-section-header.back-link
        title="Reported user"
        href="{{ route('admin.dashboard') }}"
        backLabel="Back to dashboard"
    />
    <div class="my-4 flex justify-between">
        <x-profile.simplified
            :username="$user->username"
            :image="$user->image"
            size="md"
        />
        <x-button type="submit" class="ml-auto bg-red-400">Ban user</x-button>
    </div>

    <div class="flex max-w-xl flex-col">
        @foreach ($reports as $report)
            <div class="my-4">
                <div class="flex justify-between text-sm text-slate-400">
                    <div>
                        <p>
                            Reported at:
                            <span class="text-slate-50">
                                {{ $report->created_at->diffForHumans() }}
                            </span>
                        </p>
                        <p>
                            Reported reason:
                            <span class="text-slate-50">
                                {{ $report->reason }}
                            </span>
                        </p>
                    </div>
                    <form
                        method="POST"
                        action="{{ route('clear.user.report', ['id' => $report->id, 'username' => $report->user->username]) }}"
                        class="ml-auto"
                    >
                        @csrf
                        @method('PUT')
                        <x-button size="sm" variant="secondary">
                            Clear report
                        </x-button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
