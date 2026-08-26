<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationSubmitted extends Notification
{
    use Queueable;

    public function __construct(private readonly Application $application)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $job = $this->application->job;
        $location = $job->location ? "{$job->location->city}, {$job->location->country}" : null;

        return (new MailMessage)
            ->subject("Aplikimi juaj për {$job->title} u dërgua me sukses")
            ->view('mail.application-submitted', [
                'candidateName' => $notifiable->name,
                'jobTitle' => $job->title,
                'companyName' => $job->company->name,
                'location' => $location,
                'appliedAt' => $this->application->applied_at->translatedFormat('d M Y, H:i'),
                'jobUrl' => rtrim(config('app.frontend_url'), '/')."/jobs/{$job->id}",
            ]);
    }
}
