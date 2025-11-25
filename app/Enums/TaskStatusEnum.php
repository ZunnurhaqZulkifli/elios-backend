<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TaskStatusEnum: string implements HasLabel, HasColor
{
    case NEW = 'new';
    case INPROGRESS = 'in_progress';
    case DISCUSSION = 'discussion';
    case STAGING = 'staging';
    case TESTING = 'testing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public static function options(): array
    {
        return [
            self::NEW->value        => 'New',
            self::INPROGRESS->value => 'In Progress',
            self::DISCUSSION->value => 'Discussion',
            self::STAGING->value    => 'Staging',
            self::TESTING->value    => 'Testing',
            self::COMPLETED->value  => 'Completed',
            self::CANCELLED->value  => 'Cancelled',
        ];
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::NEW        => 'New',
            self::INPROGRESS => 'In Progress',
            self::DISCUSSION => 'Discussion',
            self::STAGING    => 'Staging',
            self::TESTING    => 'Testing',
            self::COMPLETED  => 'Completed',
            self::CANCELLED  => 'Cancelled',
            default => 'Unknown',
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::NEW        => Color::Fuchsia,
            self::INPROGRESS => Color::Amber,
            self::DISCUSSION => Color::Orange,
            self::STAGING    => Color::Lime,
            self::TESTING    => Color::Emerald,
            self::COMPLETED  => Color::Green,
            self::CANCELLED  => Color::Red,
        };
    }
}
