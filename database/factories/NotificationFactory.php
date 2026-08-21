<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Notification>
 */
class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        $type = fake()->randomElement([
            'application_status_changed', 'interview_scheduled', 'new_message',
            'job_recommendation', 'application_received',
        ]);

        return [
            'user_id' => User::factory(),
            'type' => $type,
            'title' => fake()->sentence(4),
            'message' => fake()->sentence(12),
            'read_at' => fake()->boolean(50) ? fake()->dateTimeBetween('-1 month', 'now') : null,
        ];
    }
}
