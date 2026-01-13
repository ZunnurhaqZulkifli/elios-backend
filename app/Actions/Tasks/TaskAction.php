<?php

namespace App\Actions\Tasks;

use App\Actions\Modules\ModuleCalculateProgess;
use App\Enums\TaskProgressEnum;
use App\Enums\TaskStatusEnum;
use App\Models\ProjectHistory;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskAction
{
	public static function update(Task $task, array $data): void
	{
		DB::transaction(function () use ($task, $data) {
			$task->actions()->create([
				'title'       => $data['action_title'] ?? 'Task Updated',
				'type'        => $data['action_type'] ?? 'updated',
				'remarks'     => $data['action_remarks'] ?? null,
				'attachments' => $data['action_attachments'] ?? null,
			]);


			if($task->taskable) {
				ProjectHistory::create([
					'historable_type' => Task::class,
					'historable_id'   => $task->id,
					'user_id'         => Auth::user()->id,
					'title'           => 'Task Status Updated',
					'remarks'         => 'Task updated to ' . $data['status'],
					'old_values'      => json_encode($task->status->value, true),
					'new_values'      => json_encode($data['status'], true),
					'action'          => 'status_updated',
				]);
			}

			$task->update([
				'status'       => $data['status'] ?? $task->status,
				'file_name'    => $data['file_name'] ?? null,
				'progress'     => TaskProgressEnum::fromStatus($data['status']),
				'is_completed' => $data['status'] === TaskStatusEnum::COMPLETED->value ? true : false,
				'completed_at' => $data['status'] === TaskStatusEnum::COMPLETED->value ? now() : null,
			]);

			$project = $task->taskable;
			ModuleCalculateProgess::excecute($project);

			return $task;
		});
	}
}
