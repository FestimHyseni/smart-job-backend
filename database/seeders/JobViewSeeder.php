<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\JobView;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobViewSeeder extends Seeder
{
    public function run(): void
    {
        JobView::factory()
            ->recycle(Job::all())
            ->recycle(User::all())
            ->count(50)
            ->create();
    }
}
