<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewApplicationReceived extends Notification
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

        return (new MailMessage)
            ->subject("Aplikim i ri për {$job->title}")
            ->view('mail.new-application-received', [
                'employerName' => $notifiable->name,
                'candidateName' => $this->application->candidate->name,
                'jobTitle' => $job->title,
                'companyName' => $job->company->name,
                'applicantsUrl' => rtrim(config('app.frontend_url'), '/')."/employer/jobs/{$job->id}/applicants",
            ]);
    }
}
