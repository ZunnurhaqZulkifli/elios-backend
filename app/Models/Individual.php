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

    public function organizationMemberships()
    {
        return $this->hasMany(OrganizationMember::class);
    }

    public function test()
    {
        $distributions = $this->distributions()->whereNull('asnaf_segment_id')->get();
        $distributions->each(function ($d) { $d->update(['asnaf_segment_id' => 1, 'asnaf_category_id' => 2]); });
    }
}
