<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBug extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectBugFactory> */
    use HasFactory;

    protected $fillable = [
        'buggable_type',
        'buggable_id',
        'test_id',
        'discovered_by',
        'severity_id',
        'title',
        'image',
        'discovered_at',
        'status',
        'created_at',
        'updated_at',
    ];

    public function severity()
    {
        return $this->belongsTo(ProjectBugSeverity::class, 'severity_id');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'discovered_by');
    }

    public function buggable()
    {
        return $this->morphTo();
    }

    // public function test()
    // {
    //     return $this->belongsTo(ProjectTest::class, 'test_id');
    // }
}
