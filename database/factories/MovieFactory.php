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

        $posterImages = [
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3YkK3uvYsonPoZrqXhH_7sxYaqHVVP9HHnA&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJw5nkHpTPd2yb2HUGNAaldQRObBvxMZ-kHw&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ59Hq95KS8vmG2DuyXY--6gNvlAdTGxBY1FA&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTK5wTF3eGCEibG6LsLdHnxfuIW3HouZkiG7g&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNkgTYCQCJ6VEFaRvUQD5hdlNQmZCgd5oQzA&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3ekE6Hhz9gvIbiFSUPxt-FyAh4zXTXX0bjQ&s',
            'https://m.media-amazon.com/images/M/MV5BZWU5ZjJkNTQtMzQwOS00ZGE4LWJkMWUtMGQ5YjdiM2FhYmRhXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
            'https://m.media-amazon.com/images/M/MV5BZWNiZjVlZTUtNGUwYi00MjJmLTg2MDctNWEzYTJiMzY1ODc4XkEyXkFqcGc@._V1_QL75_UX480_.jpg',
            'https://m.media-amazon.com/images/M/MV5BYWVlMmM5YmMtZGJkYy00ODgxLTgyNTctYzM2MTYwZDRkYTJmXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
            'https://m.media-amazon.com/images/M/MV5BZGUxMjVmNGUtZGI4Zi00MmUxLWE1NGItOWE1MDhkOThiYmFhXkEyXkFqcGc@._V1_.jpg',

        ];

        $coverImages = [
            'https://m.media-amazon.com/images/M/MV5BNTE0MTgwMjctZDIxZC00ZDIwLTkxY2EtZmNlYjJhMjNmYWE4XkEyXkFqcGc@._V1_QL75_UX820_.jpg',
            'https://m.media-amazon.com/images/M/MV5BM2U1OGJiZTYtMzhiYi00MTc3LWJlZDYtNGI1N2Q3NWE3ODg1XkEyXkFqcGc@._V1_QL75_UY281_CR1,0,190,281_.jpg',
            'https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_.jpg',
            'https://m.media-amazon.com/images/M/MV5BNjM1ZDQxYWUtMzQyZS00MTE1LWJmZGYtNGUyNTdlYjM3ZmVmXkEyXkFqcGc@._V1_.jpg',
            'https://m.media-amazon.com/images/M/MV5BMTY4NzcwODg3Nl5BMl5BanBnXkFtZTcwNTEwOTMyMw@@._V1_.jpg',
            'https://m.media-amazon.com/images/M/MV5BY2FhZGE3NmEtNWJjOC00NDI1LWFhMTQtMjcxNmQzZmEwNGIzXkEyXkFqcGc@._V1_QL75_UX190_CR0,0,190,281_.jpg',
            'https://m.media-amazon.com/images/M/MV5BOWQ4YTBmNTQtMDYxMC00NGFjLTkwOGQtNzdhNmY1Nzc1MzUxXkEyXkFqcGc@._V1_.jpg',
            'https://m.media-amazon.com/images/M/MV5BNzIxMDQ2YTctNDY4MC00ZTRhLTk4ODQtMTVlOWY4NTdiYmMwXkEyXkFqcGc@._V1_.jpg',
            'https://m.media-amazon.com/images/M/MV5BMzdhODkyYmUtMzE3ZS00YmQxLThlMGItNTQwNGJmYTk3ZjE3XkEyXkFqcGc@._V1_QL75_UY281_CR7,0,190,281_.jpg',
            'https://m.media-amazon.com/images/M/MV5BNTg1Y2U0ZmQtMDhiMy00OWYzLWI1OWMtNzUxOWE3MGNlZjc1XkEyXkFqcGc@._V1_.jpg',


        ];

        return [
            'title' => fake()->sentence(),
            'description' => fake()->text(255),
            'director' => fake()->name(),
            'year' => fake()->year(),
            'duration' => fake()->numberBetween(60, 180),
            'poster' => fake()->randomElement($posterImages),
            'cover_image' => fake()->randomElement($coverImages),
            'rating_average' => fake()->randomFloat(1, 1, 10),
            'rating_amount' => fake()->numberBetween(1, 1000),
        ];
    }
}
