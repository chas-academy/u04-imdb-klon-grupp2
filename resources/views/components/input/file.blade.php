@props([
    'name',
    'label',
    'value' => null,
    'error',
    'informationLabel' => null,
    'existingFileUrl' => null,
])

<div
    {{ $attributes->class('flex flex-col items-start gap-1') }}
    x-data="{
        fileName:
            '{{ $existingFileUrl ? basename($existingFileUrl) : '' }}'.replace(
                /^(poster_|cover_)/,
                '',
            ),
        fileSelected: {{ $existingFileUrl ? 'true' : 'false' }},
    }"
>
    <x-input.label for="{{ $name }}">
        {{ $label }}
    </x-input.label>

    @isset($informationLabel)
        <label class="ml-2 text-xs text-slate-400">
            {{ $informationLabel }}
        </label>
    @endisset

    <x-button
        x-show="!fileSelected"
        type="button"
        size="sm"
        @click="$refs.fileInput.click()"
    >
        Choose File
    </x-button>

    <div class="ml-2 flex flex-col items-start" x-show="fileSelected">
        <div class="flex max-w-xl items-center gap-2 truncate">
            @if ($existingFileUrl)
                <span class="truncate text-sm text-slate-200">
                    <a
                        x-text="fileName"
                        href="{{ $existingFileUrl }}"
                        target="_blank"
                        class="truncate text-sm text-blue-500 underline"
                    ></a>
                </span>
            @else
                <span
                    x-text="fileName"
                    class="truncate text-sm text-slate-200"
                ></span>
            @endif

            <x-button
                variant="secondary"
                type="button"
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
