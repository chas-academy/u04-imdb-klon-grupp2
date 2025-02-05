@props([
    'user',
    'stats' => [
                'lists' => 0,
                'reviews' => 0,
                'friends' => 0
            ],
    'layout' => 'desktop',
])


<div class="bg-slate-800 flex flex-col gap-4 w-full p-4">

    <div class="flex flex-row gap-4 items-center w-auto">
        <x-avatar :image="$user->image" size="md" />

        <div class="flex flex-col gap-3 text-slate-50 w-full">
            <div class="text-lg font-bold">
                {{$user->username}}
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

    @if ($layout === 'mobile')
        <div class="self-start justify-self-end">
            <x-lucide-ellipsis-vertical class="w-6 h-6 text-slate-50" />
        </div>
    </div>

    <div class="flex flex-row gap-2">
        <x-button variant="primary" size="md" type="button">
            Notifications
        </x-button>
        <x-button variant="secondary" size="md" type="button">
            Edit
        </x-button>
    </div>
    @endif

    @if ($layout === 'desktop')
        <div class="flex flex-row gap-2 self-start justify-self-end">
            <x-button variant="primary" size="md" type="button">
                Notifications
            </x-button>
            <x-button variant="secondary" size="md" type="button">
                Edit
            </x-button>
        </div>
        <div class="self-start justify-self-end">
            <x-lucide-ellipsis-vertical class="w-6 h-6 text-slate-50" />
        </div>
    @endif
</div>