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
        $companyName = $job->company->name;

        return (new MailMessage)
            ->subject("Your application for {$job->title} was submitted")
            ->greeting("Hi {$notifiable->name},")
            ->line("Your application for **{$job->title}** at **{$companyName}** has been submitted successfully.")
            ->line('The employer will review your application and get back to you.')
            ->line('Good luck!');
    }
}
