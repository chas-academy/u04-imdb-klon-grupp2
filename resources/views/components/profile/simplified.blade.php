@props([
    'username',
    'image',
    'size',
])

<a
    href="{{ route('profile', ['username' => $username]) }}"
    @class([
        'flex items-center rounded-xs transition hover:scale-102',
        'gap-1' => $size === 'sm',
        'gap-2' => $size === 'md',
    ])
>
    <x-avatar :username="$username" :image="$image" :size="$size" />
    <p
        @class([
            'text-slate-50 ',
            'text-sm' => $size === 'sm',
            'text-base' => $size === 'md',
        ])
    >
        <a href="{{ route('profile', $username) }}">{{ $username }}</a>
    </p>
</a>
