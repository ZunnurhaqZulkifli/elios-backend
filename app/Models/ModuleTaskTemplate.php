<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleTaskTemplate extends Model
{
    protected $fillable = [
        'module_type_id',
        'title',
    ];

    public function moduleType()
    {
        return $this->belongsTo(ModuleType::class, 'module_type_id');
    }
}
