<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleType extends Model
{
    protected $fillable = [
        'name',
        'framework_id',
        'created_at',
        'updated_at',
    ];

    public function framework()
    {
        return $this->belongsTo(ProjectFramework::class);
    }
}
