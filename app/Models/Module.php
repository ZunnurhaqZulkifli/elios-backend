<?php

namespace App\Models;

use App\Enums\ModuleRoleEnum;
use App\Enums\ModuleStatusEnum;
use App\Enums\ProjectPhaseEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Module extends Model
{
    /** @use HasFactory<\Database\Factories\ModuleFactory> */
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'title',
        'project_id',
        'type_id',
        'estimated_duration',
        'total_duration',
        'progress',
        'status',
        'created_at',
        'updated_at',
        'developed_by',
        'phase',
        'role',
    ];

    protected $casts = [
        'estimated_duration' => 'datetime',
        'total_duration'     => 'datetime',
        'created_at'         => 'datetime:Y-m-d H:i:A',
        'updated_at'         => 'datetime',
        'progress'           => 'decimal:2',
        'status'             => ModuleStatusEnum::class,
        'role'               => ModuleRoleEnum::class,
        'phase'              => ProjectPhaseEnum::class,
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function developer()
    {
        return $this->belongsTo(Individual::class, 'developed_by');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function type()
    {
        return $this->belongsTo(ModuleType::class);
    }

    public function taskTemplates()
    {
        return $this->hasMany(ModuleTaskTemplate::class, 'module_type_id', 'type_id');
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
