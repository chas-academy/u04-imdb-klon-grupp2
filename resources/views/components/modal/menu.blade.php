@props(['error' => null])

<div
    class="relative flex w-full flex-col items-center gap-2 self-end sm:max-w-xl sm:self-center"
>
    <x-modal.title>{{ $title }}</x-modal.title>

    <div
        class="flex w-full flex-col gap-2 bg-slate-700 px-2 pt-4 pb-8 sm:rounded-2xl sm:p-2"
    >
        {{ $slot }}
    </div>

    <x-input.error :message="$error" class="absolute -bottom-8" />
</div>
