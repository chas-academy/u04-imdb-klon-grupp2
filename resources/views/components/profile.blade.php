@props([
    'user',
    'buttons',
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

    <div class="mr-6 flex w-full flex-row flex-wrap items-center gap-4">
        <div class="flex size-30 flex-none items-center justify-center">
            @isset($user)
                <x-avatar :image="$user->image" size="lg" />
            @else
                <x-avatar size="lg" />
            @endisset
        </div>

        <div class="flex grow flex-col gap-3 pr-10 text-slate-50">
            <div class="text-lg font-bold">
                @isset($user)
                    {{ $user->username }}
                @else
                    @username
                @endisset
            </div>
            <div class="flex flex-row gap-6 text-slate-50">
                @foreach ($stats as $stat => $sum)
                    <div class="flex flex-col">
                        <p class="text-sm font-bold">
                            {{ $sum }}
                        </p>
                        <span class="text-sm font-normal">
                            {{ $stat }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-none flex-row gap-2 self-start">
            @isset($buttons)
                {{ $buttons }}
            @endisset
        </div>
    </div>
</div>
