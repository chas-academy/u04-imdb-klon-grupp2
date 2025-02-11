<x-layout>
    @if ($myLists->isEmpty())
        <div class="mb-6">
            <x-section-header.back-link
                href="{{ route('profile', ['username' => Auth::user()->username]) }}"
                backLabel="Back to profile"
                title="My lists"
            />

            <div class="relative flex h-screen items-center justify-center">
                <div
                    class="top-1/2 flex -translate-y-1/2 transform flex-col gap-4 text-center"
                >
                    {{-- <x-empty-state content="You don’t have any lists yet!" /> --}}
                    <x-button
                        x-data
                        @click="$dispatch('open-modal', 'create-list')"
                    >
                        Create list
                    </x-button>
                </div>
            </div>
        </div>
    @else
        <div class="mt-16 mb-6 flex items-start justify-between">
            <x-section-header.back-link
                href="{{ route('profile', ['username' => Auth::user()->username]) }}"
                backLabel="Back to profile"
                title="My lists"
            />

            <div class="ml-auto flex items-center">
                <x-button
                    x-data
                    @click="$dispatch('open-modal', 'create-list')"
                >
                    Create list
                </x-button>
            </div>
        </div>
    @endif

    @auth
        <x-section :columns="[2, 'sm' => 4, 'lg' => 6]">
            @foreach ($myLists as $list)
                <x-list
                    :title="$list['title']"
                    :posters="$list['posters']->toArray()"
                    :link="route('list', ['id' => $list['id']])"
                />
            @endforeach
        </x-section>
    @endauth

    <x-create-list-modal />
</x-layout>
