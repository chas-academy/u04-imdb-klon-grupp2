<x-layout>
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
