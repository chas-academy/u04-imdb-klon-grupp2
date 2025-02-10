<x-layout>
    <div class="grid gap-3">
        <h1>{{$list->title}}</h1>
        <p>{{$list->description}}</p>
        <div class="grid grid-cols-2 gap-3">
            @foreach ($list->movies as $movie)
                <div class="col-span-1">
                    <x-movie 
                        title="{{$movie->title}}" 
                        rating="{{$movie->rating_average}}" 
                        image="{{$movie->poster}}" 
                        link="{{$movie->image_cover}}" 
                    />
                </div>
            @endforeach
        </div>
        <x-button class="w-full">Add movie</x-button>
    </div>
</x-layout>
