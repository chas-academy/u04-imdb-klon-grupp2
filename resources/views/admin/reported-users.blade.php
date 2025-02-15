<x-layout>
    <div class="my-4">
        <x-section-header.back-link
            backLabel="Back to dashboard"
            title="Reported users"
            href="{{ route('admin.dashboard') }}"
        />
    </div>

    <div class="m-auto flex max-w-xl flex-col gap-4">
        @forelse ($users as $user)
            <div class="flex items-center justify-between">
                <x-profile.simplified
                    :username="$user->username"
                    :image="$user->image"
                    size="md"
                />
                <x-button
                    href="{{ route('reported.user', $user->username) }}"
                    variant="secondary"
                    size="sm"
                    class="ml-auto"
                >
                    Check report
                </x-button>
            </div>
        @empty
            <x-empty-state content="No users found." />
        @endforelse
    </div>
</x-layout>
