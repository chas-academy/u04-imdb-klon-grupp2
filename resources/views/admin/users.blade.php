<x-layout>
    <div class="my-4">
        <x-section-header.back-link
            backLabel="Back to dashboard"
            title="All users"
            href="{{ route('admin.dashboard') }}"
        />
    </div>

    <div class="space-between m-auto max-w-xl">
        <div class="flex flex-col gap-4">
            @forelse ($users as $user)
                <div class="flex items-center justify-between">
                    <x-profile-simplified
                        :username="'@'. $user->username"
                        :image="$user->image"
                        size="md"
                    />
                    <x-button variant="secondary" size="sm" class="ml-auto">
                        Edit
                    </x-button>
                </div>
            @empty
                
            @endforelse
        </div>
    </div>
</x-layout>
