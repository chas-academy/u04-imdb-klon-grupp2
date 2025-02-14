<x-layout class="flex flex-col pt-2">
    <div class="mb-4 flex items-start justify-between gap-2 md:items-end">
        <div class="space-y-1">
            <x-section-header.back-link
                :title="$list->title"
                backLabel="Back to lists"
                href="{{ $backLink }}"
            />
            <p class="text-sm text-slate-400">
                {{ $list->description }}
            </p>
        </div>

        <div class="flex items-center gap-4">
            <x-button class="hidden md:inline-flex">Add movie</x-button>
            @if ($isListOwner)
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
                :title="$movie->title"
                :image="$movie->poster"
                :rating="$movie->rating_average"
                link="{{ route('movie', ['id' => $movie->id, 'title' => $movie->title]) }}"
            />
        @endforeach
    </x-section>

    <x-button class="mt-6 md:hidden">Add movie</x-button>

    <x-modal.base
        name="edit-list"
        :show="$errors->edit->isNotEmpty() || $errors->editListValidation->isNotEmpty()"
    >
        <x-modal.menu>
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
