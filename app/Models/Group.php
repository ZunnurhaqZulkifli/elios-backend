<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_groups', 'group_id', 'project_id');
    }
}
