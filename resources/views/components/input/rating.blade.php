@props([
    'name',
    'label',
    'value' => 0,
    'error',
])

<div x-data="{ rating: @js($value) }" class="flex flex-col gap-1">
    <x-input.label for="{{ $name }}">
        {{ $label }}
    </x-input.label>

    <div class="flex gap-1" role="radiogroup" :aria-labelledby="$name">
        @for ($i = 1; $i <= 10; $i++)
            <button
                type="button"
                aria-label="Rate {{ $i }} star{{ $i > 1 ? 's' : '' }}"
                role="radio"
                :aria-checked="rating === {{ $i }} ? 'true' : 'false'"
                tabindex="0"
                @click="rating = {{ $i }}"
                @keydown.enter="rating = {{ $i }}"
                @keydown.space.prevent="rating = {{ $i }}"
                class="cursor-pointer rounded-sm"
            >
                <x-lucide-star
                    class="size-6"
                    x-bind:class="rating >= {{ $i }} ? 'fill-indigo-400 text-indigo-400' : 'fill-transparent text-slate-400 hover:text-indigo-400 transition'"
                />
            </button>
        @endfor
    </div>

    <input type="hidden" name="{{ $name }}" x-model="rating" />
</div>
