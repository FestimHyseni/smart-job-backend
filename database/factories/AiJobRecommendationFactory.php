<?php

namespace Database\Factories;

use App\Enums\RecommendationStatus;
use App\Models\AiJobRecommendation;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AiJobRecommendation>
 */
class AiJobRecommendationFactory extends Factory
{
    protected $model = AiJobRecommendation::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'job_id' => Job::factory(),
            'match_score' => fake()->randomFloat(2, 40, 99),
            'reason' => fake()->sentence(12),
            'model_version' => 'v' . fake()->numberBetween(1, 3) . '.' . fake()->numberBetween(0, 9),
            'status' => fake()->randomElement(RecommendationStatus::cases()),
        ];
    }
}
