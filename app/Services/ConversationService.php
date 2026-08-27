<?php

namespace App\Services;

use App\Models\Conversation;

class ConversationService extends BaseCrudService
{
    protected string $model = Conversation::class;

    protected array $with = ['users', 'messages.sender'];

    public function createWithParticipants(array $participantIds): Conversation
    {
        $conversation = Conversation::create();
        $conversation->users()->attach($participantIds);

        return $conversation->load($this->with);
    }
}
