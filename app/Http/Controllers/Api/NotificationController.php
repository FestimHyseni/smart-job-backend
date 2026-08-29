<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\StoreNotificationRequest;
use App\Http\Requests\Notification\UpdateNotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(private readonly NotificationService $service)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->integer('per_page', 15), 100);

        return $this->success(NotificationResource::collection($this->service->paginate($perPage)));
    }

    public function store(StoreNotificationRequest $request): JsonResponse
    {
        $notification = $this->service->create($request->validated());

        return $this->success(new NotificationResource($notification), 'Notification created successfully.', 201);
    }

    public function show(Notification $notification): JsonResponse
    {
        return $this->success(new NotificationResource($notification->load('user')));
    }

    public function update(UpdateNotificationRequest $request, Notification $notification): JsonResponse
    {
        $notification = $this->service->update($notification, $request->validated());

        return $this->success(new NotificationResource($notification), 'Notification updated successfully.');
    }

    public function destroy(Notification $notification): JsonResponse
    {
        $this->service->delete($notification);

        return $this->success(null, 'Notification deleted successfully.');
    }
}
