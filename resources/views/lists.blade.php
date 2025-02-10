<x-layout>
    <x-button x-data @click="$dispatch('open-modal', 'create-list')">
        Create list
    </x-button>

    <x-modal.base name="create-list">
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
                        name="name"
                        :value="old('name')"
                        required
                        :error="$errors->first('name')"
                        label="Name"
                        placeholder="List name"
                        color="light"
                    />
                    <x-input.textarea
                        name="description"
                        :value="old('description')"
                        required
                        :error="$errors->first('description')"
                        label="Description"
                        placeholder="List description"
                        color="light"
                    />
                </div>

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
