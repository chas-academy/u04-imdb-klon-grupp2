@props([
    'name',
    'show' => false,
])

<div
    x-data="{
        show: @js($show),
    }"
    x-show="show"
    x-on:open-modal.window="
        if ($event.detail === '{{ $name }}') {
            show = true
        }
    "
    x-on:close-modal.window="
        if ($event.detail === '{{ $name }}') {
            show = false
        }
    "
    x-init="
        $watch('show', (show) => {
            if (show) {
                document.body.classList.add('overflow-hidden')
            } else {
                document.body.classList.remove('overflow-hidden')
            }
        })
    "
    x-cloak
    @class([
        'flex' => $show,
        'hidden' => "$show",
        'fixed inset-0 flex justify-center overflow-y-scroll',
    ])
>
    <div
        @click="show = false"
        class="absolute inset-0 bg-slate-800/80 backdrop-blur-sm"
    ></div>
    {{ $slot }}
</div>
