<?php

namespace App\Notifications;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewJobFromFollowedCompany extends Notification
{
    use Queueable;

    public function __construct(private readonly Job $job)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Vend i ri pune nga {$this->job->company->name}: {$this->job->title}")
            ->view('mail.new-job-from-followed-company', [
                'candidateName' => $notifiable->name,
                'jobTitle' => $this->job->title,
                'companyName' => $this->job->company->name,
                'jobUrl' => rtrim(config('app.frontend_url'), '/')."/jobs/{$this->job->id}",
            ]);
    }
}
