@php
    $title = Auth::check() && Auth::user()->is($user) ? 'My lists' : "$user->username's lists";
@endphp

<x-layout class="flex flex-col gap-6 pt-1 md:pt-12">
    <div class="flex items-start justify-between">
        <x-section-header.back-link
            :title="$title"
            href="{{ route('profile', ['username' => $user->username]) }}"
            backLabel="Back to profile"
        />
        @if (Auth::check() && Auth::user()->is($user))
            <x-button
                x-data
                @click="$dispatch('open-modal', 'create-list')"
                size="sm"
                class="sm:hidden"
            >
                Create list
            </x-button>
            <x-button
                x-data
                @click="$dispatch('open-modal', 'create-list')"
                size="md"
                class="hidden sm:inline-flex"
            >
                Create list
            </x-button>
        @endif
    </div>

    @if ($lists->isNotEmpty())
        <x-section :columns="[2, 'md' => 4, 'lg' => 6]">
            @foreach ($lists as $list)
                <x-list
                    :title="$list['title']"
                    :posters="$list['posters']->toArray()"
                    :link="route('list', ['id' => $list['id']])"
                />
            @endforeach
        </x-section>
    @elseif ($lists->isEmpty() && Auth::check() && Auth::user()->is($user))
        <div class="flex flex-1 flex-col items-center justify-center gap-2">
            <p class="text-slate-200">You don't have any lists yet!</p>
            <x-button
                x-data
                @click="$dispatch('open-modal', 'create-list')"
                size="md"
                class="w-full sm:w-auto"
            >
                Create list
            </x-button>
        </div>
    @else
        <div class="flex flex-1 flex-col items-center justify-center">
            <p class="text-slate-200">
                {{ $username }} doesn't have any lists yet!
            </p>
        </div>
    @endif

    <x-create-list-modal />
</x-layout>
