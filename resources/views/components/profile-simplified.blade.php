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
    <x-avatar :image="$image" :size="$size" />
    <p
        @class([
            'text-slate-50',
            'text-sm' => $size === 'sm',
            'text-base' => $size === 'md',
        ])
    >
        {{ $username }}
    </p>
</div>
