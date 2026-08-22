<?php

namespace App\Services;

use App\Models\ConversationParticipant;

class ConversationParticipantService extends BaseCrudService
{
    protected string $model = ConversationParticipant::class;

    protected array $with = ['user'];
}
