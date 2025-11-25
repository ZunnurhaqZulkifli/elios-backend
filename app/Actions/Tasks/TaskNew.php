<?php

namespace App\Actions\Tasks;

use App\Enums\TaskStatusEnum;
use App\Models\Task;

class TaskNew
{
	public static function handle(Task $task): Task
	{
		$task->status = TaskStatusEnum::NEW;
		$task->completed_at = null;
		$task->progress = 0;
		$task->save();

		return $task;
	}
}
