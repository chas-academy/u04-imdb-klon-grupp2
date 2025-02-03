<?php

use App\Models\Movie;
use App\Models\MovieList;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListMovieTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('list_movie', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MovieList::class, 'list_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(Movie::class)->constrained()->onDelete('cascade');
            $table->unique(['list_id', 'movie_id']); // Composite unique key to prevent duplicates
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_movie');
    }
}
