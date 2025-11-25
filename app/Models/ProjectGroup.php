<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGroup extends Model
{
    protected $fillable = [
        'group_id',
        'project_id',
        'task_count',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getTaskCountAttribute()
    {
        if (!$this->project || $this->project->modules->count() === 0) {
            return 0;
        }

        // Sum tasks from all modules
        return $this->project->modules->sum(function ($module) {
            return $module->tasks->count();
        });
    }
}
