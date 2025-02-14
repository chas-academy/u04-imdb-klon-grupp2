<x-layout>
    <x-button x-data @click="$dispatch('open-modal', 'create-list')">
        Create list
    </x-button>

    <x-create-list-modal />
</x-layout>
