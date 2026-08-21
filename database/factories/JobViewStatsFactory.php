<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\JobViewStats;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobViewStats>
 */
class JobViewStatsFactory extends Factory
{
    protected $model = JobViewStats::class;

    public function definition(): array
    {
        return [
            'job_id' => Job::factory(),
            'date' => fake()->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),
            'views_count' => fake()->numberBetween(0, 500),
        ];
    }
}
