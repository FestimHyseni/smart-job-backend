<?php

namespace App\Services;

use App\Models\Application;
use App\Notifications\ApplicationSubmitted;
use Illuminate\Support\Facades\Log;
use Throwable;

class ApplicationService extends BaseCrudService
{
    protected string $model = Application::class;

    protected array $with = ['job', 'candidate', 'resume'];

    public function create(array $data): Application
    {
        $data['applied_at'] = now();

        $application = parent::create($data);

        try {
            $application->candidate->notify(new ApplicationSubmitted($application));
        } catch (Throwable $e) {
            Log::error('Failed to send application confirmation email.', [
                'application_id' => $application->id,
                'error' => $e->getMessage(),
            ]);
        }

        return $application;
    }
}
