@props([
    'placeholder',
])

<div
    class="flex max-w-xs items-center gap-1 rounded-full bg-slate-700 px-4 py-2"
    x-data="{
        search: '',
        clear() {
            this.search = ''
        },
    }"
>
    <label for="{{ $attributes->get('id') }}">
        <span class="sr-only">Search</span>
        <x-lucide-search class="size-4 text-slate-50" />
    </label>

    <input
        x-model="search"
        type="text"
        id="{{ $attributes->get('id') }}"
        name="search"
        placeholder="{{ $placeholder }}"
        class="flex-1 rounded-xs px-1 text-slate-50 placeholder:text-slate-400"
    />

    <x-button
        variant="icon"
        srLabel="Clear search"
        type="button"
        x-show="search.length > 0"
        @click="clear()"
    >
        <x-lucide-x class="size-4 text-slate-400" />
    </x-button>
</div>
