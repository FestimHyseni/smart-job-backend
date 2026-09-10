<?php

namespace App\Services;

use App\Enums\NotificationType;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;

class MessageService extends BaseCrudService
{
    protected string $model = Message::class;

    protected array $with = ['sender'];

    public function __construct(private readonly NotificationService $notificationService)
    {
    }

    public function create(array $data): Model
    {
        /** @var Message $message */
        $message = parent::create($data);

        $message->load('conversation.users');

        $recipients = $message->conversation->users->where('id', '!==', $message->sender_id);
        foreach ($recipients as $recipient) {
            $this->notificationService->notify(
                $recipient->id,
                NotificationType::NewMessage,
                'Mesazh i ri',
                "{$message->sender->name} të ka dërguar një mesazh të ri.",
            );
        }

        return $message;
    }
}
