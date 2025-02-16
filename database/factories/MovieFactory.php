<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageIndex = fake()->numberBetween(0, 9);

        $posterImages = [
            'https://m.media-amazon.com/images/M/MV5BYzNhNTI2ODYtY2FiOS00MDUzLTliOTEtY2E4NDFmZDgwMDliXkEyXkFqcGc@._V1_QL75_UY562_CR309,0,380,562_.jpg',
            'https://m.media-amazon.com/images/M/MV5BNDRjY2E0ZmEtN2QwNi00NTEwLWI3MWItODNkMGYwYWFjNGE0XkEyXkFqcGc@._V1_QL75_UX380_CR0,4,380,562_.jpg',
            'https://m.media-amazon.com/images/M/MV5BYjM5NDI3NjgtYWM0Ni00ZDFkLWE0ODktMTVlZjZkOWE3ZTNhXkEyXkFqcGc@._V1_QL75_UX380_CR0,0,380,562_.jpg',
            'https://m.media-amazon.com/images/M/MV5BM2FjMjBiZjgtZDkyYy00YTRlLTk5N2QtODE2ZWIyYWE0Yzg0XkEyXkFqcGc@._V1_QL75_UX380_CR0,0,380,562_.jpg',
            'https://m.media-amazon.com/images/M/MV5BNzMyNWZlYmYtZDgxMC00ZTU3LWFiYzctNGE0ZDc0OTlhZTRlXkEyXkFqcGc@._V1_QL75_UX380_CR0,0,380,562_.jpg',
            'https://m.media-amazon.com/images/M/MV5BOTQ5Y2QyYTktYmFmZi00NWJlLWE0MzgtYTA4M2I0ZjQwZjcxXkEyXkFqcGc@._V1_QL75_UX380_CR0,4,380,562_.jpg',
            'https://m.media-amazon.com/images/M/MV5BZmM1MGM0MDQtZTAzNy00ZGJkLWI4MDUtNjBmMzdhYjhlM2QwXkEyXkFqcGc@._V1_QL75_UX380_CR0,0,380,562_.jpg',
            'https://m.media-amazon.com/images/M/MV5BNzZhMTc5MWUtOTE2MS00MjUwLTljYWEtYTk1ZmVjNzhmMzYzXkEyXkFqcGc@._V1_QL75_UX380_CR0,0,380,562_.jpg',
            'https://m.media-amazon.com/images/M/MV5BMTU3MGViZTItMmI5NS00MzMwLWFkNjctOGFlNWVmNDM0N2QyXkEyXkFqcGc@._V1_QL75_UX380_CR0,0,380,562_.jpg',
            'https://m.media-amazon.com/images/M/MV5BYmNjMDg1Y2EtNmZiOS00NGUzLThjZGYtNzU2OGI5M2VkMDFhXkEyXkFqcGc@._V1_QL75_UX380_CR0,0,380,562_.jpg',
        ];

        $coverImages = [
            'https://m.media-amazon.com/images/M/MV5BMTViZDgzNWItNWFkOC00NjZjLWExNzUtOTA3NGFlYzA4ZjIwXkEyXkFqcGc@._V1_FMjpg_UX2800_.jpg',
            'https://m.media-amazon.com/images/M/MV5BMTUxYmI2OTktYjc3Mi00ZTM0LWFkMDItMDVmMjZhOWZkZDE2XkEyXkFqcGc@._V1_FMjpg_UX2800_.jpg',
            'https://m.media-amazon.com/images/M/MV5BNjUwYzQ5NzItMmNhMS00MmI3LWIxYjAtMjdlNTQ5ZWVjNTg4XkEyXkFqcGc@._V1_FMjpg_UX2800_.jpg',
            'https://m.media-amazon.com/images/M/MV5BMjcyNjRmOTUtZjliZC00ZDJiLWI3NmMtZWZiZmNmMTk4ZTM3XkEyXkFqcGc@._V1_FMjpg_UX2800_.jpg',
            'https://m.media-amazon.com/images/M/MV5BMGRkMzhlZDAtMTgwMS00YjczLTkzY2YtZjY4NmZkMGJiMjE0XkEyXkFqcGc@._V1_FMjpg_UX1600_.jpg',
            'https://m.media-amazon.com/images/M/MV5BMDFkMjRmZTQtNGE1Yi00NmRiLWJhOWMtY2UyZTk3M2FhYTc5XkEyXkFqcGc@._V1_FMjpg_UX1600_.jpg',
            'https://m.media-amazon.com/images/M/MV5BMTBmMDlkZTMtMGUwNS00MTdiLWFkOWEtZWU4YjM1MDRiZTIxXkEyXkFqcGc@._V1_FMjpg_UX1600_.jpg',
            'https://m.media-amazon.com/images/M/MV5BZTA2ZjIxMmEtMjgzMi00MTQ5LWExNDUtNzE1ZTkwMzAyNDMzXkEyXkFqcGc@._V1_FMjpg_UX1600_.jpg',
            'https://m.media-amazon.com/images/M/MV5BN2EwNjI4NTAtMzIwOC00ZjIxLWFkOGMtNjk1NTA2ZjJkNWFmXkEyXkFqcGc@._V1_FMjpg_UX1600_.jpg',
            'https://m.media-amazon.com/images/M/MV5BNmI1MjAyNTAtNTQ2Ny00NDU2LThmODktYzQ0MWQyYjgxZGU1XkEyXkFqcGc@._V1_FMjpg_UX1600_.jpg',
        ];

        return [
            'title' => fake()->realText(rand(10, 40)),
            'description' => fake()->realText(rand(20, 255)),
            'director' => fake()->name(),
            'year' => fake()->year(),
            'duration' => fake()->numberBetween(60, 180),
            'poster' => $posterImages[$imageIndex],
            'cover_image' => $coverImages[$imageIndex],
            'rating_average' => fake()->randomFloat(1, 1, 10),
            'rating_amount' => fake()->numberBetween(1, 1000),
        ];
    }
}
