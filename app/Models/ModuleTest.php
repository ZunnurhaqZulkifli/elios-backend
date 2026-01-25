<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleTest extends Model
{
    /** @use HasFactory<\Database\Factories\ModuleTestFactory> */
    use HasFactory;

    protected $fillable = [
        'testable_type',
        'testable_id',
        'tester_id',
        'type_id',
        'title',
        'remarks',
        'tested',
        'tested_at',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'tested'     => 'boolean',
        'tested_at'  => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function tester()
    {
        return $this->belongsTo(Individual::class, 'tester_id');
    }

    public function testable()
    {
        return $this->morphTo();
    }

    // public function type()
    // {
    //     return $this->belongsTo(TestType::class, 'type_id');
    // }
}
