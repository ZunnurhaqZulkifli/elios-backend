<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;


enum ProjectPhase: string implements HasLabel, HasColor
{
    case PROTOTYPE       = 'prototype';
    case KICKOFF         = 'kickoff';
    case URS             = 'urs';
    case DEVELOPMENT     = 'development';
    case TESTING         = 'testing';
    case DEPLOYMENT      = 'deployment';
    case MAINTENANCE     = 'maintenance';
    case COMPLETED       = 'completed';
    case CHANAGE_REQUEST = 'change_request';

    public static function options(): array
    {
        return [
            self::PROTOTYPE->value       => 'Prototype',
            self::KICKOFF->value         => 'Kickoff',
            self::URS->value             => 'URS',
            self::DEVELOPMENT->value     => 'Development',
            self::TESTING->value         => 'Testing',
            self::DEPLOYMENT->value      => 'Deployment',
            self::MAINTENANCE->value     => 'Maintenance',
            self::COMPLETED->value       => 'Completed',
            self::CHANAGE_REQUEST->value => 'Change Request',
        ];
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::PROTOTYPE       => 'Prototype',
            self::KICKOFF         => 'Kickoff',
            self::URS             => 'User Req Spec',
            self::DEVELOPMENT     => 'Development',
            self::TESTING         => 'Testing',
            self::DEPLOYMENT      => 'Deployment',
            self::MAINTENANCE     => 'Maintenance',
            self::COMPLETED       => 'Completed',
            self::CHANAGE_REQUEST => 'Change Request',
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::PROTOTYPE       => Color::Gray,
            self::KICKOFF         => Color::Blue,
            self::URS             => Color::Cyan,
            self::DEVELOPMENT     => Color::Yellow,
            self::TESTING         => Color::Orange,
            self::DEPLOYMENT      => Color::Teal,
            self::MAINTENANCE     => Color::Purple,
            self::COMPLETED       => Color::Lime,
            self::CHANAGE_REQUEST => Color::Red,
        };
    }
}
