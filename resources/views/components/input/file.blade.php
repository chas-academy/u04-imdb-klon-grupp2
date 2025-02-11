@props([
    'name',
    'label',
    'placeholder',
    'value' => null,
    'error',
])
<div
    {{ $attributes->class('flex flex-col gap-1') }}
    x-data="{ fileName: '', showFileName: false }"
>
    <x-input.label for="{{ $name }}">
        {{ $label }}
    </x-input.label>
    <button
        type="button"
        id="file-upload-button"
        class="cursor-pointer"
        tabindex="0"
        aria-label="Choose File"
        @click="
            console.log('Button clicked');
            setTimeout(() => document.getElementById('file-upload').click(), 0);
        "
        @keydown.space.prevent.stop="
            console.log('Space pressed');
            setTimeout(() => document.getElementById('file-upload').click(), 0);
        "
        @keydown.enter.prevent.stop="
            console.log('Enter pressed');
            setTimeout(() => document.getElementById('file-upload').click(), 0);
        "
    >
        <x-button size="sm" class="w-32">Choose File</x-button>
    </button>
    <input
        type="file"
        x-ref="fileInput"
        id="file-upload"
        name="{{ $name }}"
        accept="image/png, image/jpeg"
        class="absolute h-0 w-0 opacity-0"
        @change="
        console.log('File selected');
        if ($refs.fileInput.files.length > 0) {
            fileName = $refs.fileInput.files[0].name;
            showFileName = true;
        }
    "
    />

    <div id="file-name" x-show="showFileName">
        <x-button
            variant="secondary"
            size="sm"
            class="w-32"
            @click="
                console.log('Change File clicked');
                setTimeout(() => document.getElementById('file-upload').click(), 0);
            "
        >
            Change File
        </x-button>
        <span id="file-display-name" x-text="fileName"></span>
    </div>
    <x-input.error message="{{ $error }}" />
</div>
