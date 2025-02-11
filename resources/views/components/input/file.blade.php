@props([
    'name',
    'label',
    'value' => null,
    'error',
    'filePickedLabel' => 'File Picked:',
])

<div
    {{ $attributes->class('flex flex-col gap-1') }}
    x-data="{ fileName: '', fileSelected: false }"
>
    <x-input.label for="{{ $name }}">
        {{ $label }}
    </x-input.label>

    <x-button
        x-show="!fileSelected"
        class="w-32"
        type="button"
        id="file-upload-button"
        size="sm"
        @click="$refs.fileInput.click()"
    >
        Choose File
    </x-button>

    <div class="flex flex-col items-start" x-show="fileSelected">
        <label for="file-upload" class="ml-2 text-xs text-slate-400">
            {{ $filePickedLabel }}
        </label>
        <div class="flex items-center">
            <span
                x-text="fileName"
                class="mt-1 mr-2 ml-2 text-sm text-slate-200"
            ></span>
            <x-button
                variant="secondary"
                class="mt-1 w-32"
                type="button"
                id="change-file-button"
                size="sm"
                @click="$refs.fileInput.click()"
            >
                Change File
            </x-button>
        </div>
    </div>

    <input
        type="file"
        name="{{ $name }}"
        id="{{ $name }}"
        class="hidden"
        value="{{ $value }}"
        x-ref="fileInput"
        @change="
            fileSelected = $refs.fileInput.files.length > 0;
            fileName = fileSelected ? $refs.fileInput.files[0].name : '';
        "
    />
    <x-input.error message="{{ $error }}" />
</div>
