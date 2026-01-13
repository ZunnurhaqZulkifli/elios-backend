<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ModuleStatusEnum: string implements HasLabel, HasColor
{
  case NEW = 'new';
  case IN_PROGRESS = 'in_progress';
  case COMPLETED = 'completed';

  public static function options(): array
  {
    return [
      self::NEW->value => 'New',
      self::IN_PROGRESS->value => 'In Progress',
      self::COMPLETED->value => 'Completed',
    ];
  }

  public function getLabel(): string
  {
    return match ($this) {
      self::NEW => 'New',
      self::IN_PROGRESS => 'In Progress',
      self::COMPLETED => 'Completed',
    };
  }

  public function getColor(): array|string|null
  {
    return match ($this) {
      self::NEW => Color::Purple,
      self::IN_PROGRESS => Color::Amber,
      self::COMPLETED => Color::Green,
    };
  }
}
