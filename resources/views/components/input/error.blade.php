@props([
    'message',
])

@if ($message)
    <span class="text-sm text-red-400">
        {{ $message }}
    </span>
@endif
