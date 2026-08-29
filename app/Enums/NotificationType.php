<?php

namespace App\Enums;

enum NotificationType: string
{
    case ApplicationSubmitted = 'application_submitted';
    case ApplicationStatusUpdated = 'application_status_updated';
    case NewApplicationReceived = 'new_application_received';
    case InterviewScheduled = 'interview_scheduled';
}
