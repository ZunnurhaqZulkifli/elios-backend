<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHistory extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectHistoryFactory> */
    use HasFactory;

    protected $table = 'project_histories';

    protected $fillable = [
        'historable_type',
        'historable_id',
        'user_id',
        'title',
        'remarks',
        'old_values',
        'new_values',
        'action',
        'created_at',
        'updated_at',
    ];
}
