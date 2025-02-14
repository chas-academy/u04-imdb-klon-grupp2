<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\Review;
use App\Models\User;
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
        $isReviewReport = $this->faker->boolean;
        $reviewId = $isReviewReport ? Review::all()->random()->id : null;
        $userId = ! $isReviewReport ? User::all()->random()->id : null;

        return [
            'reason' => $this->faker->realText(rand(50, 255)),
            'review_id' => $reviewId,
            'user_id' => $userId,
        ];
    }
}
