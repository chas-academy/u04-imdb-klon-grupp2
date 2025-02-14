@props([
    'username',
    'image',
    'size',
])

<div
    @class([
        'flex',
        'items-center',
        'gap-1' => $size === 'sm',
        'gap-2' => $size === 'md',
    ])
>
    <x-avatar :username="$username" :image="$image" :size="$size" />
    <p
        @class([
            'text-slate-50',
            'text-sm' => $size === 'sm',
            'text-base' => $size === 'md',
        ])
    >
        <a href="{{ route('profile', $username) }}">{{ $username }}</a>
    </p>
</div>
