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
    case TESTING = 'testing';
    case STAGING = 'staging';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public static function options(): array
    {
        return [
            self::NEW->value        => 'New',
            self::INPROGRESS->value => 'In Progress',
            self::DISCUSSION->value => 'Discussion',
            self::TESTING->value    => 'Testing',
            self::STAGING->value    => 'Staging',
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
            self::TESTING    => 'Testing',
            self::STAGING    => 'Staging',
            self::COMPLETED  => 'Completed',
            self::CANCELLED  => 'Cancelled',
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::NEW        => Color::Fuchsia,
            self::INPROGRESS => Color::Amber,
            self::DISCUSSION => Color::Orange,
            self::TESTING    => Color::Emerald,
            self::STAGING    => Color::Lime,
            self::COMPLETED  => Color::Green,
            self::CANCELLED  => Color::Red,
        };
    }

    public function actionColor(): array|string|null
    {
        return match ($this) {
            self::NEW        => Color::Amber,
            self::INPROGRESS => Color::Orange,
            self::DISCUSSION => Color::Yellow,
            self::TESTING    => Color::Lime,
            self::STAGING    => Color::Emerald,
            self::COMPLETED  => Color::Gray,
            self::CANCELLED  => Color::Red,
        };
    }

    public function actionLabel(): string
    {
        return match ($this) {
            self::NEW        => 'Start Progress',
            self::INPROGRESS => 'Do Task',
            self::DISCUSSION => 'Move to Testing',
            self::TESTING    => 'Move to Staging',
            self::STAGING    => 'Complete Task',
            self::COMPLETED  => 'Task Completed',
            self::CANCELLED  => 'Task Cancelled',
        };
    }
}
