<?php

namespace App\Actions\Tasks;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Models\TaskLevel;
use DateTime;

class TaskSuggestDate
{
	public static function handle($level): DateTime
	{
		// ROT : start from 9 AM till 6 PM cutoff
    // checks if available slot in the day, if not move to next day
    // create a sync task // command to run every hour to check for pending tasks and move them if past cutoff

    $now = now();
    $cutoff = now()->setHour(18)->setMinute(0)->setSecond(0);
    $start = now()->setHour(9)->setMinute(0)->setSecond(0);

    $suggestedDate = now();

    $last_due_task_date = Task::whereDate('suggested_date', $now->toDateString())
      ->orderBy('created_at', 'desc')
      ->pluck('suggested_date')
      ->first();

    $task_level = TaskLevel::find($level);
    $additionalHours = $task_level?->hours;

    if ($last_due_task_date) {
      $last_due = now()->parse($last_due_task_date);
      $suggestedDate = $last_due->addHours($additionalHours);

      if ($suggestedDate->greaterThan($cutoff)) {
        $overflowHours = $suggestedDate->diffInHours($cutoff);
        $suggestedDate = $start->addDay()->addHours($overflowHours);
      }
      
    } else {

      // kalau tiada task pada hari tersebut
      $suggestedDate = $now->addHours($additionalHours);

      if ($suggestedDate->greaterThan($cutoff)) {
        $overflowHours = $suggestedDate->diffInHours($cutoff);
        $suggestedDate = $start->addDay()->addHours($overflowHours);
      }
    }

    return $suggestedDate;
	}
}
