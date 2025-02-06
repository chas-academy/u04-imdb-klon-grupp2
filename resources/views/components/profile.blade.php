@props([
    'user',
    'buttons',
    'stats' => [
                'lists' => 0,
                'reviews' => 0,
                'friends' => 0
            ],
])

<div class="flex relative w-full">

    <div class="absolute top-0 right-0">
        <x-lucide-ellipsis-vertical class="w-6 h-6 text-slate-50" />
    </div>

    <div class="flex flex-wrap flex-row gap-4 items-center w-full mr-6">
        <div class="flex flex-none size-30 justify-center items-center">
            @isset($user)
                <x-avatar :image="$user->image" size="lg" />
            @else
                <x-avatar size="lg" />
            @endisset
        </div>

        <div class="flex grow flex-col gap-3 text-slate-50 pr-10">
            <div class="text-lg font-bold">
                @isset($user)
                    {{$user->username}}
                @else
                    @username
                @endisset
            </div>
            <div class="flex flex-row text-slate-50 gap-6">
                @foreach ($stats as $stat => $sum)
                <div class="flex flex-col">
                    <p class="font-bold text-sm">
                        {{$sum}}
                    </p>
                    <span class="font-normal text-sm">
                        {{$stat}}
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