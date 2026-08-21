<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Location;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        Job::factory()
            ->recycle(Company::all())
            ->recycle(JobCategory::all())
            ->recycle(Location::all())
            ->count(50)
            ->create();
    }
}
