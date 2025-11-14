<?php

namespace App\Enums;

enum JobPosition : string
{
    case INTERN = 'intern';
    case JUNIOR = 'junior';
    case SENIOR = 'senior';
    case MANAGER = 'manager';
    case DIRECTOR = 'director';
    case EXECUTIVE = 'executive';
}
