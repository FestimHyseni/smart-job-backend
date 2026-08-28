<?php

namespace App\Services;

use App\Models\Interview;
use App\Notifications\InterviewScheduled;
use Illuminate\Support\Facades\Log;
use Throwable;

class InterviewService extends BaseCrudService
{
    protected string $model = Interview::class;

    protected array $with = ['application.job.company', 'application.job.location', 'application.candidate', 'application.resume'];

    public function create(array $data): Interview
    {
        /** @var Interview $interview */
        $interview = parent::create($data);

        try {
            $interview->application->candidate->notify(new InterviewScheduled($interview));
        } catch (Throwable $e) {
            Log::error('Failed to send interview scheduled email.', [
                'interview_id' => $interview->id,
                'error' => $e->getMessage(),
            ]);
        }

        return $interview;
    }
}
