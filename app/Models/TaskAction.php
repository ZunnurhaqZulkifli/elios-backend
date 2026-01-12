<?php

namespace App\Models;

use App\Enums\TaskActionTypeEnum;
use Illuminate\Database\Eloquent\Model;

class TaskAction extends Model
{
    protected $table = 'task_actions';

    protected $fillable = [
        'task_id',
        'title',
        'type',
        'remarks',
        'attachments',
    ];

    protected $casts = [
        'remarks'     => 'string',
        'type'        => TaskActionTypeEnum::class,
        'attachments' => 'array',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
