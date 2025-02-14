<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateRatingTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_calculates_the_correct_average_rating()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create(['rating_average' => 0, 'rating_amount' => 0]);

        $movie->reviews()->create(['rating' => 5, 'movie_id' => $movie->id, 'user_id' => $user->id]);
        $movie->reviews()->create(['rating' => 3, 'movie_id' => $movie->id, 'user_id' => $user->id]);

        $movie->updateRating();

        // (5 + 3) / 2 = 4
        $this->assertEquals(4, $movie->fresh()->rating_average);
    }

    public function test_it_increments_rating_amount()
    {
        $movie = Movie::factory()->create(['rating_amount' => 5]);

        $movie->updateRating();

        $this->assertEquals(6, $movie->fresh()->rating_amount);
    }

    public function test_it_updates_the_database_correctly()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create(['rating_average' => 0, 'rating_amount' => 0]);

        $movie->reviews()->create(['rating' => 4, 'movie_id' => $movie->id, 'user_id' => $user->id]);
        $movie->reviews()->create(['rating' => 2, 'movie_id' => $movie->id, 'user_id' => $user->id]);

        $movie->updateRating();

        $this->assertDatabaseHas('movies', [
            'id' => $movie->id,
            'rating_average' => 3, // (4 + 2) / 2 = 3
            'rating_amount' => 1, // increments from 0 to 1
        ]);
    }

    public function test_it_rounds_the_rating_average_to_one_decimal_place()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create(['rating_average' => 0, 'rating_amount' => 0]);

        $movie->reviews()->create(['rating' => 5, 'movie_id' => $movie->id, 'user_id' => $user->id]);
        $movie->reviews()->create(['rating' => 8, 'movie_id' => $movie->id, 'user_id' => $user->id]);
        $movie->reviews()->create(['rating' => 7, 'movie_id' => $movie->id, 'user_id' => $user->id]);

        $movie->updateRating();

        // (5 + 8 + 7) / 3 = 6.666...
        $this->assertEquals(6.7, $movie->fresh()->rating_average);
    }
}
