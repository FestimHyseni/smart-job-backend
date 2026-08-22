<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StoreMessageRequest;
use App\Http\Requests\Message\UpdateMessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Services\MessageService;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    public function __construct(private readonly MessageService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(MessageResource::collection($this->service->paginate()));
    }

    public function store(StoreMessageRequest $request): JsonResponse
    {
        $message = $this->service->create($request->validated());

        return $this->success(new MessageResource($message), 'Message sent successfully.', 201);
    }

    public function show(Message $message): JsonResponse
    {
        return $this->success(new MessageResource($message->load('sender')));
    }

    public function update(UpdateMessageRequest $request, Message $message): JsonResponse
    {
        $message = $this->service->update($message, $request->validated());

        return $this->success(new MessageResource($message), 'Message updated successfully.');
    }

    public function destroy(Message $message): JsonResponse
    {
        $this->service->delete($message);

        return $this->success(null, 'Message deleted successfully.');
    }
}
