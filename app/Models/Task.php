<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'taskable_type',
        'taskable_id',
        'assigned_by',
        'type_id',
        'level_id',
        'title',
        'remarks',
        'file_name',
        'suggested_date',
        'due_date',
        'is_completed',
        'completed_at',
        'progress',
        'status',
        'created_at',
        'updated_at',
    ];

    public function taskable()
    {
        return $this->morphTo();
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function type()
    {
        return $this->hasOne(TaskType::class, 'type_id');
    }

    public function level()
    {
        return $this->hasOne(TaskLevel::class, 'level_id');
    }
}
