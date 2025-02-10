@props([
    'name',
    'show' => false,
])

<div
    x-data="{
        show: @js($show),
        focusables() {
            const selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)].filter(element => !element.hasAttribute('disabled'))
        },
        firstFocusable() {
            return this.focusables()[0]
        },
        lastFocusable() {
            return this.focusables().slice(-1)[0]
        },
        nextFocusable() {
            const focusables = this.focusables()
            const nextFocusableIndex = (focusables.indexOf(document.activeElement) + 1) % (focusables.length + 1)

            return focusables[nextFocusableIndex] || this.firstFocusable()
        },
        prevFocusable() {
            const focusables = this.focusables()
            const prevFocusableIndex = Math.max(0, focusables.indexOf(document.activeElement)) -1

            return focusables[prevFocusableIndex] || this.lastFocusable()
        },
    }"
    x-show="show"
    x-init="
        $watch('show', (show) => {
            if (show) {
                document.body.classList.add('overflow-hidden')
            } else {
                document.body.classList.remove('overflow-hidden')
            }
        })
    "
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
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-cloak
    @class([
        'flex' => $show,
        'hidden' => "$show",
        'fixed inset-0 z-50 flex justify-center overflow-y-scroll',
    ])
>
    <div
        @click="show = false"
        class="absolute inset-0 bg-slate-800/80 backdrop-blur-sm"
    ></div>
    {{ $slot }}
</div>
