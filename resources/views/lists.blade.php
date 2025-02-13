@php
    $title = $isCurrentUserProfile ? 'My lists' : "$username's lists";
@endphp

<x-layout class="flex flex-col gap-6 pt-1 md:pt-12">
    <div class="flex items-start justify-between">
        <x-section-header.back-link
            :title="$title"
            href="{{ route('profile', ['username' => $username]) }}"
            backLabel="Back to profile"
        />
        @if ($isCurrentUserProfile && ! $lists->isEmpty())
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
                    link="{{ route('list', ['id' => $list['id']]) }}"
                />
            @endforeach
        </x-section>
    @elseif ($lists->isEmpty() && $isCurrentUserProfile)
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

    <x-modal.base
        name="create-list"
        :show="$errors->createList->isNotEmpty() || $errors->createListValidation->isNotEmpty()"
    >
        <x-modal.input>
            <x-slot:title>Create a new list</x-slot>
            <form
                method="post"
                action="{{ route('list.store') }}"
                class="flex flex-col gap-6"
            >
                @csrf
                <div class="flex flex-col gap-4">
                    <x-input.text
                        name="title"
                        :value="old('title')"
                        required
                        :error="$errors->createListValidation->first('title')"
                        label="Name"
                        placeholder="List name"
                        color="light"
                    />
                    <x-input.textarea
                        name="description"
                        :value="old('description')"
                        required
                        :error="$errors->createListValidation->first('description')"
                        label="Description"
                        placeholder="List description"
                        color="light"
                    />
                </div>

                <x-input.error :message="$errors->createList->first()" />

                <div class="flex gap-2">
                    <x-button
                        x-data
                        @click="$dispatch('close-modal', 'create-list')"
                        type="button"
                        variant="secondary"
                    >
                        Cancel
                    </x-button>
                    <x-button class="flex-1">Create list</x-button>
                </div>
            </form>
        </x-modal.input>
    </x-modal.base>
</x-layout>
