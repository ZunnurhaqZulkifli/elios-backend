<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Individual extends Model
{
    /** @use HasFactory<\Database\Factories\IndividualFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'display_name',
        'title',
        'position',
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

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function organization()
    {
        return $this->hasManyThrough(
            Organization::class,
            OrganizationMember::class,
            'individual_id', // Foreign key on OrganizationIndividual table...
            'id', // Foreign key on Organization table...
            'id', // Local key on Individual table...
            'organization_id' // Local key on OrganizationIndividual table...
        );
    }
}
