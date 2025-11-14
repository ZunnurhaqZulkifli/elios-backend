<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'ownerable_type',
        'ownerable_id',
        'pic',
        'type_id',
        'category_id',
        'title',
        'description',
        'start_at',
        'end_at',
        'projected_end_at',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'projected_end_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d H:i:A',
        'updated_at' => 'datetime',
        'status' => ProjectStatus::class,
    ];

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function detail()
    {
        return $this->hasOne(ProjectDetail::class);
    }

    public function history()
    {
        return $this->hasMany(ProjectHistory::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function ownerable()
    {
        return $this->morphTo();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'pic');
    }

    public function type()
    {
        return $this->belongsTo(ProjectType::class, 'type_id');
    }
}
