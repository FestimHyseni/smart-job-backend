<?php

namespace Database\Seeders;

use App\Models\AiJobRecommendation;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class AiJobRecommendationSeeder extends Seeder
{
    public function run(): void
    {
        AiJobRecommendation::factory()
            ->recycle(User::all())
            ->recycle(Job::all())
            ->count(50)
            ->create();
    }
}
