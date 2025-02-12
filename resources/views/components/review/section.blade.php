@props([
  'reviews',
  'href'
])

<div class="flex flex-col gap-3">

<div class="flex justify-between">
    <h1 class="text-2xl font-bold">Reviews</h1>
    <x-button variant="secondary" size="sm" href="{{ $href }}">Write a review</x-button>
</div>

@foreach ($reviews as $review)
  <x-review
        :title="$review->movie->title"
        :content="$review->content"
        :created_at="$review->created_at"
        :rating="$review->rating"
        link="{{ route('review', $review->id) }}"
        :username="$review->user->username" 
    />
@endforeach
<a class="flex self-end text-indigo-400" href="{{ $href }}">Show more</a>

</div>