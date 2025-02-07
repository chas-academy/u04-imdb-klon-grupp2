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

<section
    style="{{ $styleAttributeValue }}"
    @class([
        'grid *:size-full' => ! $scrollableOnMobile,
        'hide-scrollbar relative -mr-4 flex snap-x overflow-x-scroll *:snap-start *:not-[.gradient]:min-w-32 sm:mr-0 sm:grid sm:*:size-full' => $scrollableOnMobile,
        'sm:grid-cols-(--section-grid-cols-sm)' => isset($columns['sm']),
        'md:grid-cols-(--section-grid-cols-md)' => isset($columns['md']),
        'lg:grid-cols-(--section-grid-cols-lg)' => isset($columns['lg']),
        'grid-cols-(--section-grid-cols-base) gap-4',
    ])
>
    {{ $slot }}
    @if ($scrollableOnMobile)
        <div
            class="gradient pointer-events-none sticky -right-4 min-h-full min-w-12 bg-linear-to-l from-slate-800 to-slate-800/0 sm:hidden"
        ></div>
    @endif
</section>
