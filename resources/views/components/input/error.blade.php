@props([
    'message',
])

@if ($message)
    <span {{ $attributes->twMerge('text-sm text-red-400') }}>
        {{ $message }}
    </span>
@endif
