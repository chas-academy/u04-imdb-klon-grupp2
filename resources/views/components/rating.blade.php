@props([
    'rating',
    'size',
    'bold' => false,
])

<div
    @class([
        'flex items-center',
        'gap-0.5' => $size === 'sm',
        'gap-1' => $size === 'md' || $size === 'lg',
    ])
>
    <span
        @class([
            'text-indigo-200',
            'text-xs' => $size === 'sm',
            'text-base' => $size === 'md',
            'text-lg' => $size === 'lg',
            'font-bold' => $bold,
        ])
    >
        {{ $rating }}
    </span>
    <x-lucide-star
        @class([
            'text-indigo-400 *:fill-current',
            'size-3' => $size === 'sm',
            'size-4' => $size === 'md',
            'size-6' => $size === 'lg',
        ])
    />
</div>
