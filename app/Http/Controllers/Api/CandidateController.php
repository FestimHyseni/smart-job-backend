<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateDetailResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function show(Request $request, User $user): JsonResponse
    {
        abort_unless($user->role === UserRole::Candidate, 404);
        abort_unless(in_array($request->user()->role, [UserRole::Employer, UserRole::Admin], true), 403);

        $user->load([
            'candidateProfile.location',
            'candidateSkills.skill',
            'experiences',
            'educations',
            'candidateLanguages',
            'resumes',
        ]);

        return $this->success(new CandidateDetailResource($user));
    }
}
