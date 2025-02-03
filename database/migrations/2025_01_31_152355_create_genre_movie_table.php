<?php

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('genre_movie', function (Blueprint $table) {

            $table->id();
            $table->foreignIdFor(Movie::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Genre::class)->constrained()->onDelete('cascade');
            $table->unique(['movie_id', 'genre_id']); // Composite unique key to prevent duplicates
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_movie');
    }
};
