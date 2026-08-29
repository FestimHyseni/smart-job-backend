<?php

namespace App\Services;

use App\Enums\NotificationType;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotificationService extends BaseCrudService
{
    protected string $model = Notification::class;

    protected array $with = ['user'];

    public function markAsRead(Notification $notification): Notification
    {
        $notification->update(['read_at' => now()]);

        return $notification;
    }

    public function notify(int $userId, NotificationType $type, string $title, string $message): void
    {
        try {
            Notification::create([
                'user_id' => $userId,
                'type' => $type,
                'title' => $title,
                'message' => $message,
            ]);
        } catch (Throwable $e) {
            Log::error('Failed to create in-app notification.', [
                'user_id' => $userId,
                'type' => $type->value,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
