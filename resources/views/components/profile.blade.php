@props([
    'user',
    'stats' => [
        'lists' => 0,
        'reviews' => 0,
        'friends' => 0,
    ],
    
])

<div class="relative flex w-full">
    <div class="absolute top-0 right-0">
        <x-lucide-ellipsis-vertical class="size-6 text-slate-50" />
    </div>

    <div class="mr-8 flex w-full flex-row flex-wrap items-center gap-4">
        <x-avatar :image="$user->image ?? null" size="lg" />

        <div class="flex grow flex-col gap-3 text-slate-50">
            <div class="text-lg font-bold">
                {{ $user->username ?? 'username' }}
            </div>
            <div class="flex gap-6 text-slate-50">
                @foreach ($stats as $stat => $sum)
                    <div class="flex flex-col">
                        <p class="text-sm font-bold">
                            {{ $sum }}
                        </p>
                        <span class="text-sm font-normal text-slate-200">
                            {{ $stat }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-none flex-row gap-2 self-start">
            {{ $slot }}
        </div>
    </div>
</div>
