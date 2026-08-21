<?php

namespace App\Enums;

enum InterviewType: string
{
    case Online = 'online';
    case Physical = 'physical';
    case Phone = 'phone';
}
