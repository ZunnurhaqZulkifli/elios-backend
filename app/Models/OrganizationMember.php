<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationMember extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'organization_id',
        'individual_id',
    ];

    // add position in individuals

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function individual()
    {
        return $this->belongsTo(Individual::class);
    }
}
