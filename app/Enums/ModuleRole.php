<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ModuleRole : string implements HasLabel, HasColor
{
    case DEVELOPER = 'developer';
    case MAINTAINER = 'maintainer';
    case TESTER = 'tester';

    public static function options(): array
    {
        return [
            self::DEVELOPER->value => 'Developer',
            self::MAINTAINER->value => 'Maintainer',
            self::TESTER->value => 'Tester',
        ];
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::DEVELOPER => 'Developer',
            self::MAINTAINER => 'Maintainer',
            self::TESTER => 'Tester',
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::DEVELOPER => Color::Blue,
            self::MAINTAINER => Color::Orange,
            self::TESTER => Color::Pink,
        };
    }
}
