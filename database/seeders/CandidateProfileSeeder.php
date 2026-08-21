<?php

namespace Database\Seeders;

use App\Models\CandidateProfile;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;

class CandidateProfileSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::inRandomOrder()->pluck('id')->all();

        foreach (array_slice($userIds, 0, 50) as $userId) {
            CandidateProfile::factory()
                ->recycle(Location::all())
                ->create(['user_id' => $userId]);
        }
    }
}
