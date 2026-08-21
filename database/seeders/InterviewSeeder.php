<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Interview;
use Illuminate\Database\Seeder;

class InterviewSeeder extends Seeder
{
    public function run(): void
    {
        Interview::factory()
            ->recycle(Application::all())
            ->count(50)
            ->create();
    }
}
