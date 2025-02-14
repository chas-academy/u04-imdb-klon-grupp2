<x-layout>
    @if ($myLists->isEmpty())
        <div class="mb-6">
    @else
        <div class="mt-16 mb-6 flex items-start justify-between">
    @endif

    @if (Auth::check() && Auth::user()->is($user))
            <x-section-header.back-link
                title="My lists"
                backLabel="Back to profile"
                href="{{ route('profile', ['username' => Auth::user()->username]) }}"
            />

            @if ($myLists->isEmpty())
            <div class="relative flex h-screen items-center justify-center">
                <div
                    class="flex -translate-y-1/2 transform flex-col gap-4 text-center"
                >
                    <x-empty-state content="You don’t have any lists yet!" />
            @else
                    <div class="ml-auto flex items-center">
            @endif
                    <x-button
                        x-data
                        class="sm:px-2 sm:py-1 md:px-6 md:py-2"
                        @click="$dispatch('open-modal', 'create-list')"
                    >
                        Create list
                    </x-button>
                </div>
            </div>
        </div>
    @else
            <x-section-header.back-link
                title="{{ $user->username }}'s lists"
                backLabel="Back to profile"
                href="{{ route('profile', ['username' => $user->username]) }}"
            />

            @if ($myLists->isEmpty())
                <div class="relative flex h-screen items-center justify-center">
                    <div
                        class="flex -translate-y-1/2 transform flex-col gap-4 text-center"
                    >
                        <x-empty-state
                            content="{{ $user->username }} doesn’t have any lists yet!"
                        />
                    </div>
                </div>
            @endif
        </div>
    @endif

    <x-section :columns="[2, 'sm' => 4, 'lg' => 6]">
        @foreach ($myLists as $list)
            <x-list
                :title="$list['title']"
                :posters="$list['posters']->toArray()"
                :link="route('list', ['id' => $list['id']])"
            />
        @endforeach
    </x-section>


    <x-create-list-modal />
</x-layout>
