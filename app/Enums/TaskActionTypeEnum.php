<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TaskActionTypeEnum: string implements HasLabel, HasColor
{
  case CREATE = 'created';  // created a new file
  case UPDATE = 'updated';  // updated an existing file
  case DELETE = 'deleted';  // deleted a file
  case FIX    = 'fixed';    // fixed an issue

  public static function options(): array
  {
    return [
      self::CREATE->value   => 'Created',
      self::UPDATE->value   => 'Updated',
      self::DELETE->value   => 'Deleted',
      self::FIX->value      => 'Fixed',
    ];
  }

  public function getLabel(): string
  {
    return match ($this) {
      self::CREATE   => 'Created',
      self::UPDATE   => 'Updated',
      self::DELETE   => 'Deleted',
      self::FIX      => 'Fixed',
    };
  }

  public function getColor(): array|string|null
  {
    return match ($this) {
      self::CREATE   => Color::Blue,
      self::UPDATE   => Color::Yellow,
      self::DELETE   => Color::Red,
      self::FIX      => Color::Green,
    };
  }
}
