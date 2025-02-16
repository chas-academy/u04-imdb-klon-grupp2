<x-layout class="">
    <x-section-header.back-link
        backLabel="Back to dashboard"
        title="Edit movie"
        href="{{ route('admin.dashboard') }}"
    />
    <div class="m-auto max-w-xl">
        <div class="flex flex-col gap-12 pt-4 md:pt-8">
            <form
                method="POST"
                action="{{ route('admin.save.movie', $movie->id) }}"
                class="flex flex-col gap-8"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-4">
                    <x-input.text
                        name="title"
                        :value="old('title') ? old('title') : $movie->title"
                        autofocus
                        required
                        :error="$errors->first('title')"
                        label="Title"
                        placeholder="Enter the movie title"
                    />

                    <x-input.text
                        name="year"
                        :value="old('year') ? old('year') : $movie->year"
                        autofocus
                        required
                        :error="$errors->first('year')"
                        label="Year"
                        placeholder="Enter the release year of the movie"
                    />

                    <x-input.text
                        name="director"
                        :value="old('director') ? old('director') : $movie->director"
                        autofocus
                        required
                        :error="$errors->first('director')"
                        label="Director"
                        placeholder="Enter the movie director"
                    />

                    <x-input.text
                        name="duration"
                        :value="old('duration') ? old('duration') : $movie->duration"
                        autofocus
                        required
                        :error="$errors->first('duration')"
                        label="Duration"
                        placeholder="Enter the movie duration (e.g. 2h 30m)"
                    />

                    <x-input.textarea
                        name="description"
                        :value="old('description') ? old('description') : $movie->description"
                        label="Description"
                        :error="$errors->first('description')"
                        placeholder="Enter the movie description"
                    />

                    <x-input.file
                        :error="$errors->first('poster')"
                        name="poster"
                        existingFileUrl="{{ getFileUrl('storage/movies/' . $movie->id, $movie->poster) }}"
                        label="Poster"
                    />

                    <x-input.file
                        :error="$errors->first('cover_image')"
                        name="cover_image"
                        existingFileUrl="{{ getFileUrl('storage/movies/' . $movie->id, $movie->cover_image) }}"
                        label="Cover image"
                    />

                    <x-button type="submit" size="md">Update movie</x-button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
