<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\JobView;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobView>
 */
class JobViewFactory extends Factory
{
    protected $model = JobView::class;

    public function definition(): array
    {
        return [
            'job_id' => Job::factory(),
            'user_id' => fake()->boolean(70) ? User::factory() : null,
            'ip_address' => fake()->ipv4(),
            'viewed_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
