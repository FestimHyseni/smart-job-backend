<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Conversation\StoreConversationRequest;
use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use App\Services\ConversationService;
use Illuminate\Http\JsonResponse;

class ConversationController extends Controller
{
    public function __construct(private readonly ConversationService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(ConversationResource::collection($this->service->paginate()));
    }

    public function store(StoreConversationRequest $request): JsonResponse
    {
        $conversation = $this->service->createWithParticipants($request->validated()['participant_ids']);

        return $this->success(new ConversationResource($conversation), 'Conversation created successfully.', 201);
    }

    public function show(Conversation $conversation): JsonResponse
    {
        return $this->success(new ConversationResource($conversation->load(['users', 'messages'])));
    }

    public function destroy(Conversation $conversation): JsonResponse
    {
        $this->service->delete($conversation);

        return $this->success(null, 'Conversation deleted successfully.');
    }
}
