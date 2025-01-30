<?php

namespace Database\Seeders;

use App\Models\Movie;
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
        Movie::factory(100)->create();
        ListFactory::new()->count(10)->create();
    }
}