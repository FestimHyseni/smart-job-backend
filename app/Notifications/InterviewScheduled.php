<?php

namespace App\Notifications;

use App\Models\Interview;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InterviewScheduled extends Notification
{
    use Queueable;

    public function __construct(private readonly Interview $interview)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $job = $this->interview->application->job;

        $typeLabels = [
            'online' => 'Online',
            'physical' => 'Fizike',
            'phone' => 'Telefonike',
        ];

        return (new MailMessage)
            ->subject("Intervistë e caktuar për {$job->title}")
            ->view('mail.interview-scheduled', [
                'candidateName' => $notifiable->name,
                'jobTitle' => $job->title,
                'companyName' => $job->company->name,
                'scheduledAt' => $this->interview->scheduled_at->translatedFormat('d M Y, H:i'),
                'typeLabel' => $typeLabels[$this->interview->type->value] ?? $this->interview->type->value,
                'location' => $this->interview->location,
                'meetingUrl' => $this->interview->meeting_url,
                'notes' => $this->interview->notes,
                'applicationsUrl' => rtrim(config('app.frontend_url'), '/').'/my-applications',
            ]);
    }
}
