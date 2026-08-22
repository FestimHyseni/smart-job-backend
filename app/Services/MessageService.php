<?php

namespace App\Services;

use App\Models\Message;

class MessageService extends BaseCrudService
{
    protected string $model = Message::class;

    protected array $with = ['sender'];
}
