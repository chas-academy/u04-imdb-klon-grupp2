@props([
    'username',
    'image',
    'size',
])

<div class="flex items-center gap-2">
    <x-avatar :image="$image" :size="$size" />
    <p class="text-slate-50">{{ $username }}</p>
</div>
