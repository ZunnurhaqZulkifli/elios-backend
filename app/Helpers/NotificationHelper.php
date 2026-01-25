<?php

namespace App\Helpers;

use Filament\Notifications\Notification;

class NotificationHelper
{

  public static function make($type = '', $title = 'okay', $icon = 'heroicon-o-bell', $duration = 3000)
  {
    if ($type == 'success') {
      Notification::make()
        ->duration($duration)
        ->title($title)
        ->icon($icon)
        ->success()
        ->send();
    }

    if ($type == 'error') {
      Notification::make()
        ->duration($duration)
        ->title($title)
        ->icon($icon)
        ->danger()
        ->send();
    }

    if ($type == 'warning') {
      Notification::make()
        ->duration($duration)
        ->title($title)
        ->icon($icon)
        ->warning()
        ->send();
    }

    if ($type == 'info') {
      Notification::make()
        ->duration($duration)
        ->title($title)
        ->icon($icon)
        ->info()
        ->send();
    }

    return;
  }
}
