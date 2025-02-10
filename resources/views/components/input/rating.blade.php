<div x-data="{ rating: 0 }" class="flex flex-col gap-1">
    <span class="font-semibold text-slate-50" id="rating-label">
        {{ $label }}
    </span>

    <div
        class="flex space-x-1"
        role="radiogroup"
        aria-labelledby="rating-label"
    >
        @for ($i = 1; $i <= 10; $i++)
            <button
                type="button"
                class="focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                aria-label="Rate {{ $i }} star{{ $i > 1 ? 's' : '' }}"
                role="radio"
                :aria-checked="rating === {{ $i }} ? 'true' : 'false'"
                tabindex="0"
                @click="rating = {{ $i }}"
                @keydown.enter="rating = {{ $i }}"
                @keydown.space.prevent="rating = {{ $i }}"
            >
                <x-lucide-star
                    class="h-6 w-6"
                    x-bind:class="rating >= {{ $i }} ? 'fill-indigo-400 text-indigo-400' : 'fill-transparent text-slate-400'"
                />
            </button>
        @endfor
    </div>
</div>
