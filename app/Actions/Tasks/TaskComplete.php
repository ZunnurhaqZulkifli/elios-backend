<?php

namespace App\Actions\Tasks;

use App\Enums\TaskStatusEnum;
use App\Models\Task;

class TaskComplete
{
	public function handle(Task $task): Task
	{
		$task->status = TaskStatusEnum::COMPLETED;
		$task->completed_at = now();
		$task->progress = 80;
		$task->save();

		return $task;
	}
}
