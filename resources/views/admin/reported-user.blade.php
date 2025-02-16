@php
    use Carbon\Carbon;
@endphp

<x-layout class="space-y-4 pt-4">
    <x-section-header.back-link
        title="{{ $user->username . ' report' }}"
        href="{{ route('admin.dashboard') }}"
        backLabel="Back to dashboard"
    />

    <div class="flex flex-col justify-start">
        <div class="flex items-center justify-between">
            <x-profile.simplified
                :username="$user->username"
                :image="$user->image"
                size="md"
            />

            @if ($user->isBanned())
                <span class="text-sm text-slate-400">
                    User is banned until
                    {{ Carbon::parse($user->banned_until)->format('F jS') }}
                </span>
            @else
                <x-button
                    x-data
                    @click="$dispatch('open-modal', 'ban-user')"
                    class="bg-red-400 hover:bg-red-500"
                >
                    Ban user
                </x-button>
            @endif
        </div>

        <div class="flex flex-col gap-8">
            @foreach ($reports as $report)
                <div class="my-4 flex max-w-xl flex-col gap-6">
                    <div class="flex flex-col gap-4 text-sm text-slate-400">
                        <div class="flex flex-col gap-2">
                            <p>
                                Reported
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
    </div>

    <x-ban-user-modal :errors="$errors" :user="$user" />
</x-layout>
