<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CurrentProject extends Model
{
    use LogsActivity;

    protected $fillable = [
        'project_id'
    ];
    
    public static function id()
    {
        return self::first()?->project_id ?? null;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('current_project')
            ->logFillable()
            ->logOnlyDirty();
    }
}
