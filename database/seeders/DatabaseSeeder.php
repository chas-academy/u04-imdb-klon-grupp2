<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Report;
use App\Models\User;
use Database\Factories\ListFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();
        $movies = Movie::factory(100)->create();
        $lists = ListFactory::new()->count(50)->create();

        foreach ($users as $user) {
            $user->lists()->attach(
                $lists->random(rand(1, 5))->pluck('id'),
                [
                    'status' => fake()->randomElement(['pending', 'accepted']),
                    'role' => fake()->randomElement(['owner', 'collaborator']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        foreach ($lists as $list) {
            $list->movies()->attach(
                $movies->random(rand(1, 20))->pluck('id'),
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $genres = ['Action', 'Comedy', 'Drama', 'Horror', 'Science Fiction', 'Thriller', 'Romance'];
        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }

        Report::factory(20)->create();
    }
}
