@props([
    'errors',
    'user',
])

<x-modal.base
    name="ban-user"
    :show="$errors->banUser->isNotEmpty() || $errors->banUserValidation->isNotEmpty()"
>
    <x-modal.input>
        <x-slot:title>
            {{ $user->username }}
        </x-slot>

        <form
            method="post"
            action="{{ route('profile.ban', ['id' => $user->id]) }}"
            class="flex flex-col gap-6"
        >
            @csrf
            @method('put')

            <div class="flex flex-col gap-4">
                <x-input.date
                    name="date"
                    :value="old('date')"
                    required
                    :error="$errors->banUserValidation->first('date')"
                    label="Until when should this user be banned?"
                    color="light"
                />
            </div>

            <x-input.error :message="$errors->banUser->first()" />

            <div class="flex gap-2">
                <x-button
                    x-data
                    @click="$dispatch('close-modal', 'ban-user')"
                    type="button"
                    variant="secondary"
                >
                    Cancel
                </x-button>
                <x-button class="flex-1">Save</x-button>
            </div>
        </form>
    </x-modal.input>
</x-modal.base>
