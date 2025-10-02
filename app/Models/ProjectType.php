<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    protected $fillable = [
        'name',
        'weight',
        'status',
        'created_at',
        'updated_at',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'type_id');
    }
}
