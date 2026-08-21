<?php

namespace Database\Factories;

use App\Models\Education;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Education>
 */
class EducationFactory extends Factory
{
    protected $model = Education::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-10 years', '-4 years');

        return [
            'user_id' => User::factory(),
            'institution' => fake()->company() . ' University',
            'degree' => fake()->randomElement(['Bachelor', 'Master', 'PhD', 'Associate Degree']),
            'field' => fake()->randomElement([
                'Computer Science', 'Software Engineering', 'Information Technology',
                'Business Administration', 'Design', 'Marketing', 'Data Science',
            ]),
            'start_date' => $start,
            'end_date' => fake()->dateTimeBetween($start, '-1 year'),
            'description' => fake()->optional()->paragraph(2),
        ];
    }
}
