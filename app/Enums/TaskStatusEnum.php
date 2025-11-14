<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TaskStatusEnum: string implements HasLabel, HasColor
{
    case NEW = 'new';
    case INPROGRESS = 'in_progress';
    case DISCUSSED = 'discussed';
    case STAGED = 'staged';
    case TESTED = 'tested';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public static function options(): array
    {
        return [
            self::NEW->value => 'New',
            self::INPROGRESS->value => 'In Progress',
            self::DISCUSSED->value => 'Discussed',
            self::STAGED->value => 'Staged',
            self::TESTED->value => 'Tested',
            self::COMPLETED->value => 'Completed',
            self::CANCELLED->value => 'Cancelled',
        ];
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::NEW => 'New',
            self::INPROGRESS => 'In Progress',
            self::DISCUSSED => 'Discussed',
            self::STAGED => 'Staged',
            self::TESTED => 'Tested',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
            default => 'Unknown',
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::NEW => Color::Fuchsia,
            self::INPROGRESS => Color::Amber,
            self::DISCUSSED => Color::Orange,
            self::STAGED => Color::Lime,
            self::TESTED => Color::Emerald,
            self::COMPLETED => Color::Green,
            self::CANCELLED => Color::Red,
        };
    }
}
