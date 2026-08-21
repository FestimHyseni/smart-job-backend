<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        Message::factory()
            ->recycle(Conversation::all())
            ->recycle(User::all())
            ->count(50)
            ->create();
    }
}
