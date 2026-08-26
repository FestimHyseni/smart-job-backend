<?php

namespace App\Notifications;

use App\Enums\ApplicationStatus;
use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusUpdated extends Notification
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
        $status = $this->application->status;

        [$emoji, $headline, $color, $message] = match ($status) {
            ApplicationStatus::Shortlisted => ['🎯', 'U përzgjodhe në listën e ngushtë!', '#2563eb', 'Punëdhënësi po e shqyrton më nga afër profilin tuaj. Qëndroni gati për hapat e ardhshëm.'],
            ApplicationStatus::Interview => ['🎉', 'Jeni ftuar për intervistë!', '#7c3aed', 'Punëdhënësi do t\'ju kontaktojë së shpejti për të organizuar intervistën.'],
            ApplicationStatus::Accepted => ['✅', 'Urime! Aplikimi juaj u pranua.', '#16a34a', 'Punëdhënësi do t\'ju kontaktojë me detajet e mëtejshme. Suksese në rolin e ri!'],
            ApplicationStatus::Rejected => ['📪', 'Përditësim për aplikimin tuaj', '#dc2626', 'Këtë herë punëdhënësi ka vendosur të vazhdojë me kandidatë të tjerë. Mos u dekurajoni — vazhdoni të aplikoni!'],
            ApplicationStatus::Reviewed => ['👀', 'Aplikimi juaj u shqyrtua', '#0891b2', 'Punëdhënësi e ka parë aplikimin tuaj dhe po e vlerëson.'],
            default => ['📄', 'Statusi i aplikimit tuaj u përditësua', '#6b7280', 'Mund ta ndiqni statusin e aplikimit tuaj në çdo kohë nga llogaria juaj.'],
        };

        return (new MailMessage)
            ->subject("{$headline} — {$job->title}")
            ->view('mail.application-status-updated', [
                'candidateName' => $notifiable->name,
                'jobTitle' => $job->title,
                'companyName' => $job->company->name,
                'statusLabel' => ucfirst($status->value),
                'statusEmoji' => $emoji,
                'statusHeadline' => $headline,
                'statusMessage' => $message,
                'accentColor' => $color,
                'jobUrl' => rtrim(config('app.frontend_url'), '/')."/jobs/{$job->id}",
            ]);
    }
}
