<?php

namespace Database\Seeders;

use App\Models\Genre;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Genre::factory(10)->create();
    }
}
