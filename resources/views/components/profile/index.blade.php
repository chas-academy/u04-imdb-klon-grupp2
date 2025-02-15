@props([
    'user',
    'statistics',
])

<div class="relative flex w-full">
    <div
        class="mr-10 flex w-full flex-col gap-4 md:flex-row md:items-center md:justify-between"
    >
        <div class="flex items-center gap-4">
            <x-avatar
                :username="$user->username"
                :image="$user->image"
                size="lg"
            />

            <div class="flex grow flex-col gap-3 text-slate-50">
                <div class="text-lg font-bold">
                    {{ $user->username }}
                </div>
                <div class="flex gap-6 text-slate-50">
                    @foreach ($statistics as $name => $number)
                        <div class="flex flex-col text-sm">
                            <p class="font-bold">
                                {{ $number }}
                            </p>
                            <span class="text-slate-200">
                                {{ $name }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @isset($buttons)
            <div class="flex flex-none gap-2 self-start">
                {{ $buttons }}
            </div>
        @endisset
    </div>

    <x-button
        x-data
        @click="$dispatch('open-modal', 'profile-menu')"
        variant="icon"
        srLabel="Open profile menu"
        class="absolute top-0 right-0"
    >
        <x-lucide-ellipsis-vertical class="size-6 text-slate-50" />
    </x-button>
</div>
