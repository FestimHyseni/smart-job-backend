<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class GuestApplicationService
{
    public function __construct(
        private readonly ApplicationService $applicationService,
        private readonly ResumeService $resumeService,
    ) {
    }

    public function apply(array $data, UploadedFile $resumeFile): Application
    {
        $user = User::where('email', $data['email'])->first();

        if ($user && $user->role !== UserRole::Candidate) {
            throw ValidationException::withMessages([
                'email' => 'Ky email është regjistruar tashmë me një lloj tjetër llogarie. Ju lutemi identifikohuni.',
            ]);
        }

        if (! $user) {
            $user = User::create([
                'name' => trim("{$data['first_name']} {$data['last_name']}"),
                'email' => $data['email'],
                'password' => Hash::make(Str::random(40)),
                'role' => UserRole::Candidate,
            ]);
        }

        if (Application::where('job_id', $data['job_id'])->where('candidate_id', $user->id)->exists()) {
            throw ValidationException::withMessages([
                'job_id' => 'Ke aplikuar tashmë për këtë pozitë.',
            ]);
        }

        $resume = $this->resumeService->store($user->id, $resumeFile, true);

        return $this->applicationService->create([
            'job_id' => $data['job_id'],
            'candidate_id' => $user->id,
            'resume_id' => $resume->id,
            'cover_letter' => $data['cover_letter'] ?? null,
            'experience_summary' => $data['experience_summary'] ?? null,
        ]);
    }
}
