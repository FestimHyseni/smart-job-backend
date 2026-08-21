<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Employer = 'employer';
    case Candidate = 'candidate';
}
