<?php

namespace Database\Factories;

use App\Enums\InterviewStatus;
use App\Enums\InterviewType;
use App\Models\Application;
use App\Models\Interview;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Interview>
 */
class InterviewFactory extends Factory
{
    protected $model = Interview::class;

    public function definition(): array
    {
        $type = fake()->randomElement(InterviewType::cases());

        return [
            'application_id' => Application::factory(),
            'scheduled_at' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'type' => $type,
            'location' => $type === InterviewType::Physical ? fake()->address() : null,
            'meeting_url' => $type === InterviewType::Online ? fake()->url() : null,
            'notes' => fake()->optional()->paragraph(2),
            'status' => fake()->randomElement(InterviewStatus::cases()),
        ];
    }
}
