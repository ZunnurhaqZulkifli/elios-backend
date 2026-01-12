<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBranch extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectBranchFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
