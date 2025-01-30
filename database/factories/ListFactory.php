<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MovieList;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MovieList>
 */
class ListFactory extends Factory
{
    protected $model = MovieList::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realText(rand(10, 80)),
            'description' => fake()->realText(rand(10, 255)),
            'visibility' => fake()->randomElement(['public', 'private', 'friends']),
        ];
    }
}
