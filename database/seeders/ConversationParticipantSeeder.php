<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\User;
use Illuminate\Database\Seeder;

class ConversationParticipantSeeder extends Seeder
{
    public function run(): void
    {
        $conversationIds = Conversation::pluck('id')->all();
        $userIds = User::pluck('id')->all();

        $pairs = [];
        foreach ($conversationIds as $conversationId) {
            foreach ($userIds as $userId) {
                $pairs[] = [$conversationId, $userId];
            }
        }
        shuffle($pairs);

        foreach (array_slice($pairs, 0, 50) as [$conversationId, $userId]) {
            ConversationParticipant::factory()->create([
                'conversation_id' => $conversationId,
                'user_id' => $userId,
            ]);
        }
    }
}
