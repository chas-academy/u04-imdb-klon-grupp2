@props([
    'message',
])

@if ($message)
    <span {{ $attributes->class('text-sm text-red-400') }}>
        {{ $message }}
    </span>
@endif
