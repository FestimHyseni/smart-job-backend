<?php

namespace Database\Factories;

use App\Models\CandidateProfile;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CandidateProfile>
 */
class CandidateProfileFactory extends Factory
{
    protected $model = CandidateProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'headline' => fake()->jobTitle(),
            'bio' => fake()->paragraph(3),
            'location_id' => Location::factory(),
            'years_experience' => fake()->numberBetween(0, 20),
            'expected_salary' => fake()->numberBetween(500, 8000),
            'salary_currency' => fake()->randomElement(['EUR', 'USD', 'GBP']),
            'linkedin_url' => fake()->url(),
            'github_url' => fake()->url(),
            'portfolio_url' => fake()->url(),
        ];
    }
}
