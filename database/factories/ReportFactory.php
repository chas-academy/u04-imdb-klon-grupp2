<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'review_id' => Review::factory(),
            'reason' => $this->faker->paragraph,
            'user_id' => User::factory(),
        ];
    }
}
