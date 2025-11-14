<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pic',
        'name',
        'display_name',
        'type',
        'about',
        'location',
        'phone',
        'address_1',
        'address_2',
        'country_id',
        'state_id',
        'city_id',
        'postcode',
        'priority',
        'status',
    ];

    public function members()
    {
        return $this->hasMany(OrganizationMember::class);
    }
}
