<x-layout class="flex flex-col pt-2">
    <div class="mb-4 flex items-start justify-between gap-2 md:items-end">
        <div class="space-y-1">
            <x-section-header.back-link
                :title="$list->title"
                backLabel="Back"
                href="{{ $backLink }}"
            />
            <p class="text-sm text-slate-400">
                {{ $list->description }}
            </p>
        </div>

        <div class="flex items-center gap-4">
            @if ($isListOwner)
                <x-button x-data @click="$dispatch('open-modal', 'add-movie')">
                    Add movie
                </x-button>
                <x-button
                    x-data
                    @click="$dispatch('open-modal', 'edit-list')"
                    variant="icon"
                    srLabel="Open list settings"
                >
                    <x-lucide-ellipsis-vertical class="size-6" />
                </x-button>
            @endif
        </div>
    </div>

    <x-section :columns="[2, 'sm' => 4, 'md' => 6]">
        @foreach ($list->movies as $movie)
            <x-movie
                :id="$movie->id"
                :title="$movie->title"
                :image="$movie->poster"
                :rating="$movie->rating_average"
                link="{{ route('movie', ['id' => $movie->id, 'title' => $movie->title]) }}"
            />
        @endforeach
    </x-section>

    @if ($isListOwner)
        <x-button class="mt-6 md:hidden">Add movie</x-button>
    @endif

    <x-modal.base
        name="add-movie"
        :show="$errors->edit->isNotEmpty() || $errors->editListValidation->isNotEmpty()"
    >
        <div
            class="mt-header-mobile sm:mt-header-desktop mb-16 flex w-full max-w-5xl flex-1 flex-col items-center justify-center gap-4 px-4 md:mb-20"
        >
            <div class="overflow-auto">
                <x-section :columns="[2, 'md' => 6]">
                    @php
                        $topThirtyMovies = app('App\Http\Controllers\ListController')->getTopThirtyMovies($list->id);
                    @endphp

                    @foreach ($topThirtyMovies as $movie)
                        <div class="flex flex-col gap-2">
                            <div class="h-80">
                                <x-movie
                                    :title="$movie->title"
                                    :rating="number_format($movie->rating, 1)"
                                    :image="$movie->poster"
                                    link="{{ route('movie', ['id' => $movie->id, 'title' => Str::slug($movie->title)]) }}"
                                    :id="$movie->id"
                                />
                            </div>
                            <div
                                class="items-bottom mt-2 flex w-full justify-center"
                            >
                                <form
                                    method="post"
                                    action="{{ route('list.add-to-list', ['listId' => $list['id'], 'movieId' => $movie->id]) }}"
                                >
                                    @csrf
                                    @method('put')

                                    <x-button class="w-full">
                                        Add to list
                                    </x-button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </x-section>
            </div>
        </div>
    </x-modal.base>

    <x-modal.base name="edit-list" :show="$errors->deleteList->isNotEmpty()">
        <x-modal.menu :error="$errors->deleteList->first()">
            <x-slot:title>
                {{ $list->title }}
            </x-slot>
            {{-- TODO: add edit mode --}}
            <x-menu-item>Edit</x-menu-item>
            <x-modal.divider />
            {{-- TODO: open change visibility modal --}}
            <x-menu-item>Change visibility</x-menu-item>
            <x-modal.divider />
            <form
                method="post"
                action="{{ route('list.destroy', ['id' => $list->id]) }}"
            >
                @csrf
                @method('delete')
                <x-menu-item variant="destructive">Delete list</x-menu-item>
            </form>
            <x-modal.divider />
            <x-menu-item
                x-data
                @click="$dispatch('close-modal', 'edit-list')"
                variant="highlights"
            >
                Cancel
            </x-menu-item>
        </x-modal.menu>
    </x-modal.base>
</x-layout>
