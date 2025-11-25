<?php

namespace App\Models;

use App\Enums\ProjectPhase;
use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'ownerable_type',
        'ownerable_id',
        'pic',
        'type_id',
        'category_id',
        'framework_id',
        'title',
        'description',
        'start_at',
        'end_at',
        'projected_end_at',
        'status',
        'phase',
        'git_url',
        'live_url',
        'staging_url',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_at' => 'datetime:Y-m-d',
        'end_at' => 'datetime:Y-m-d',
        'projected_end_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d H:i:A',
        'updated_at' => 'datetime',
        'status' => ProjectStatus::class,
        'phase' => ProjectPhase::class,
        'category_id' => 'integer',
        'type_id' => 'integer',
    ];

    public function tasks()
    {
        return Task::query()
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('taskable_type', Project::class)
                        ->where('taskable_id', $this->id);
                })
                    ->orWhereIn('taskable_id', function ($subQuery) {
                        $subQuery->select('id')
                            ->from('modules')
                            ->where('project_id', $this->id);
                    })
                    ->where('taskable_type', Module::class);
            });
    }

    public function getAllTasks()
    {
        return $this->tasks()->get();
    }

    public function group()
    {
        return $this->hasManyThrough(Group::class, ProjectGroup::class, 'project_id', 'id', 'id', 'group_id');
    }

    public function personInCharge()
    {
        return $this->belongsTo(Individual::class, 'pic');
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function detail()
    {
        return $this->hasOne(ProjectDetail::class);
    }

    public function history()
    {
        return $this->hasMany(ProjectHistory::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function framework()
    {
        return $this->belongsTo(ProjectFramework::class, 'framework_id');
    }

    public function ownerable()
    {
        return $this->morphTo();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'pic');
    }

    public function type()
    {
        return $this->belongsTo(ProjectType::class, 'type_id');
    }

    /* Activity Logs */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('projects')
            ->logFillable()
            ->logOnlyDirty();
    }
}
