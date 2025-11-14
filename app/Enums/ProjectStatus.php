<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProjectStatus : string implements HasLabel, HasColor
{
    case NEW = 'new';
    case DEVELOPMENT = 'development';
    case ACTIVE = 'active';
    case COMPLETED = 'completed'; 

    public static function options(): array
    {
        return [
            self::NEW->value => 'New',
            self::DEVELOPMENT->value => 'Development',
            self::ACTIVE->value => 'Active',
            self::COMPLETED->value => 'Completed',
        ];
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::NEW => 'New',
            self::DEVELOPMENT => 'Development',
            self::ACTIVE => 'Active',
            self::COMPLETED => 'Completed',
            default => 'Unknown',
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::NEW => Color::Purple,
            self::DEVELOPMENT => Color::Yellow,
            self::ACTIVE => Color::Green,
            self::COMPLETED => Color::Blue,
        };
    }
}
