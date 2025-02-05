@props([
    'title',
    'extraLabel' => null,
    'href' => null,
    'backLabel' => 'Back',
])

<div class="m-6 flex flex-col">
    <x-section-header.back-link
        title="The Worst Person in The World"
        href="#"
        extraLabel="Review"
    />
</div>

<div class="m-6 flex flex-col">
    <x-section-header.link
        title="Best Movies 2025"
        extraLabel="Featured"
        href="/dashboard"
    />
</div>

<div class="m-6 flex flex-col">
    <x-section-header.no-link title="Action" extraLabel="Public" />
</div>
