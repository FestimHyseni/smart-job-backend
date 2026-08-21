<?php

namespace App\Enums;

enum CompanyUserRole: string
{
    case Owner = 'owner';
    case Recruiter = 'recruiter';
}
