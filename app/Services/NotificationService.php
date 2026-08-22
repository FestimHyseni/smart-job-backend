<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService extends BaseCrudService
{
    protected string $model = Notification::class;

    protected array $with = ['user'];

    public function markAsRead(Notification $notification): Notification
    {
        $notification->update(['read_at' => now()]);

        return $notification;
    }
}
