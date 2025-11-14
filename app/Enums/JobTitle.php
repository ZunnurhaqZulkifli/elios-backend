<?php

namespace App\Enums;

enum JobTitle : string
{
    case DEVELOPER = 'developer';
    case INTERN = 'intern';
    case SENIOR = 'senior';
    case MANAGER = 'manager';
    case TESTER = 'tester';
    case CEO = 'ceo';
    case CTO = 'cto';
}
