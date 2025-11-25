<?php

namespace App\Models;

use App\Enums\ProjectPhase;
use App\Enums\TaskStatusEnum;
use Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'taskable_type',
        'taskable_id',
        'assigned_by',
        'type_id',
        'level_id',
        'pic',
        'title',
        'remarks',
        'file_name',
        'suggested_date',
        'due_date',
        'is_completed',
        'completed_at',
        'progress',
        'status',
        'project_phase',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'status' => TaskStatusEnum::class,
        'is_completed' => 'boolean',
        'suggested_date' => 'datetime',
        'due_date' => 'datetime',
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'project_phase' => ProjectPhase::class,
    ];

    public function taskable()
    {
        return $this->morphTo();
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function personInCharge()
    {
        return $this->belongsTo(Individual::class, 'pic');
    }

    public function type()
    {
        return $this->belongsTo(TaskType::class, 'type_id');
    }

    public function level()
    {
        return $this->belongsTo(TaskLevel::class, 'level_id');
    }

    public function getColumnData(string $day)
    {
        $date = now()->format('Y-m') . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);

        $query = $this->whereDate('due_date', $date)
            ->whereNotIn('status', [
                TaskStatusEnum::COMPLETED,
            ]);

        $project = CurrentProject::id();

        if ($project) {
            $query->where(function (Builder $q) use ($project) {
                $q->whereHasMorph('taskable', [\App\Models\Project::class], function (Builder $query) use ($project) {
                    $query->where('id', $project);
                })
                ->orWhereHasMorph('taskable', [\App\Models\Module::class], function (Builder $query) use ($project) {
                    $query->where('project_id', $project);
                });
            });
        }

        if ($query->count() == 0) {
            $query = $this->whereDate('suggested_date', $date)
                ->get();
        }

        $pendingTasks = $query->count();

        $colors = array_merge(
            [0 => 'background-color: #1c2740; color: white; font-weight: 700;'],
            array_fill(1, 5, 'background-color: #66db00; color: black; font-weight: 700;'),
            array_fill(6, 10, 'background-color: #EAB308; color: black; font-weight: 700;'),
            array_fill(11, 30, 'background-color: #c97704; color: black; font-weight: 700;'),
            array_fill(31, 100, 'background-color: #c90404; color: black; font-weight: 700;')
        );

        // if($day == 28) {
        //     dd([
        //         $query->count(),
        //     ]);
        // }

        $data = [
            'count' => $pendingTasks,
            'color' => $colors[$pendingTasks],
        ];

        return $data;
    }

    /* Activity Logs */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('modules')
            ->logFillable()
            ->logOnlyDirty();
    }
}
