<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskLevel extends Model
{
    protected $fillable = [
        'name',
        'weight',
        'hours',
        'status',
        'created_at',
        'updated_at',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'level_id');
    }
}
