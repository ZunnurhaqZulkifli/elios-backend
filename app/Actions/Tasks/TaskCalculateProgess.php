<?php

namespace App\Actions\Tasks;

use App\Enums\TaskProgressEnum;
use App\Models\Module;
use Illuminate\Support\Facades\DB;

class TaskCalculateProgess
{
	public static function excecute(Module $module)
	{
		$total = DB::transaction(function () use ($module) {
			// // total tasks
			$totalTasks = $module->tasks->count();

			// // total percentage
			$totalPercentage = 0;

			// // total per task percentage
			$perTaskPercentage = $totalTasks > 0 ? 100 / $totalTasks : 0;

			foreach ($module->tasks as $task) {
				$task->update([
					'progress' => TaskProgressEnum::fromStatus($task->status->value),
				]);

				$totalPercentage += $perTaskPercentage * ($task->progress / 100);
			}

			return $totalPercentage;
		});
		
		return round($total, 2);
	}
}
