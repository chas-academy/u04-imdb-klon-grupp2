<x-layout>
    <div class="my-4 flex justify-between">
        <x-section-header.back-link
            title="{{ $user->username . ' report' }}"
            href="{{ route('admin.dashboard') }}"
            backLabel="Back to dashboard"
        />
    </div>

    <div class="flex flex-col justify-start">
        <div class="flex max-w-xl flex-row items-center justify-between gap-1">
            <div class="flex items-center justify-center gap-2 text-center">
                <x-profile.simplified
                    :username="$user->username"
                    :image="$user->image"
                    size="md"
                />
            </div>
            <x-button
                size="md"
                type="submit"
                class="bg-red-400 hover:bg-red-500"
            >
                Ban user
            </x-button>
        </div>
        <div>
            @foreach ($reports as $report)
                <div class="my-4 max-w-xl">
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
                            <div class="flex h-full items-center">
                                <x-button size="sm" variant="secondary">
                                    Clear report
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
