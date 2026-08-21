<?php

namespace App\Enums;

enum RecommendationStatus: string
{
    case Active = 'active';
    case Dismissed = 'dismissed';
    case Applied = 'applied';
    case Stale = 'stale';
}
