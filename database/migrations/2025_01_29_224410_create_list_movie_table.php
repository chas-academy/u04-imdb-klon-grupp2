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
            $table->foreignIdfor(MovieList::class, 'list_id')->constrained()->onDelete('cascade');
            $table->foreignIdfor(Movie::class)->constrained()->onDelete('cascade');
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
