<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProjectStatusEnum : string implements HasLabel, HasColor
{
    case UNICORN = 'unicorn';
    case NEW     = 'new';
    case DOWN    = 'down';
    case LIVE    = 'live';

    public static function options(): array
    {
        return [
            self::UNICORN->value => 'Unicord',
            self::NEW->value     => 'New',
            self::DOWN->value    => 'Down',
            self::LIVE->value    => 'Live',
        ];
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::UNICORN => 'Unicorn',
            self::NEW     => 'New',
            self::DOWN    => 'Down',
            self::LIVE    => 'Live',
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::UNICORN => Color::Emerald,
            self::NEW     => Color::Purple,
            self::DOWN    => Color::Red,
            self::LIVE    => Color::Green,
        };
    }
}
