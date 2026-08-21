<?php

namespace Database\Factories;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Experience>
 */
class ExperienceFactory extends Factory
{
    protected $model = Experience::class;

    public function definition(): array
    {
        $isCurrent = fake()->boolean(25);
        $start = fake()->dateTimeBetween('-8 years', '-1 year');

        return [
            'user_id' => User::factory(),
            'company_name' => fake()->company(),
            'position' => fake()->jobTitle(),
            'description' => fake()->optional()->paragraph(2),
            'start_date' => $start,
            'end_date' => $isCurrent ? null : fake()->dateTimeBetween($start, 'now'),
            'is_current' => $isCurrent,
        ];
    }
}
