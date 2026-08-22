<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConversationParticipant\StoreConversationParticipantRequest;
use App\Http\Resources\ConversationParticipantResource;
use App\Models\ConversationParticipant;
use App\Services\ConversationParticipantService;
use Illuminate\Http\JsonResponse;

class ConversationParticipantController extends Controller
{
    public function __construct(private readonly ConversationParticipantService $service)
    {
    }

    public function index(): JsonResponse
    {
        return $this->success(ConversationParticipantResource::collection($this->service->paginate()));
    }

    public function store(StoreConversationParticipantRequest $request): JsonResponse
    {
        $participant = $this->service->create($request->validated());

        return $this->success(new ConversationParticipantResource($participant), 'Participant added successfully.', 201);
    }

    public function show(ConversationParticipant $conversationParticipant): JsonResponse
    {
        return $this->success(new ConversationParticipantResource($conversationParticipant->load('user')));
    }

    public function destroy(ConversationParticipant $conversationParticipant): JsonResponse
    {
        $this->service->delete($conversationParticipant);

        return $this->success(null, 'Participant removed successfully.');
    }
}
