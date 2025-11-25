<?php

namespace App\Actions\Tasks;

use App\Enums\TaskStatusEnum;
use App\Models\Task;

class TaskTesting
{
	public static function handle(Task $task): Task
	{
		$task->status = TaskStatusEnum::TESTING;
		$task->progress = 70;
		$task->save();

		return $task;
	}
}
