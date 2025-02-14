@props([
    'columns',
    'scrollableOnMobile' => false,
])

@php
    if (! isset($columns[0])) {
        throw new Exception('a start column value must be provided');
    }

    $twVariables = [];

    foreach ($columns as $breakpoint => $number) {
        if ($breakpoint === 0) {
            $twVariables[] = generateSectionGridVariable('base', $number);
        } else {
            $twVariables[] = generateSectionGridVariable($breakpoint, $number);
        }
    }

    $styleAttributeValue = implode('; ', $twVariables);
@endphp

<section class="relative w-full">
    <div
        style="{{ $styleAttributeValue }}"
        @class([
            'grid *:size-full' => ! $scrollableOnMobile,
            'hide-scrollbar -mr-4 flex snap-x overflow-x-scroll pr-4 *:shrink-0 *:snap-start *:not-[.gradient]:w-32 sm:mr-0 sm:grid sm:overflow-visible sm:pr-0 sm:*:not-[.gradient]:size-full sm:*:not-[.gradient]:min-w-32' => $scrollableOnMobile,
            'sm:grid-cols-(--section-grid-cols-sm)' => isset($columns['sm']),
            'md:grid-cols-(--section-grid-cols-md)' => isset($columns['md']),
            'lg:grid-cols-(--section-grid-cols-lg)' => isset($columns['lg']),
            'grid-cols-(--section-grid-cols-base) gap-4',
        ])
    >
        {{ $slot }}
    </div>
    @if ($scrollableOnMobile)
        <div
            class="gradient pointer-events-none absolute inset-y-0 -right-4 min-w-12 bg-linear-to-l from-slate-800 to-slate-800/0 sm:hidden"
        ></div>
    @endif
</section>
