<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'desc', 'image', 'agency_id', 'category_id', 'company_details', 'address', 'number', 'email'];

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id')->with('country', 'city', 'state');
    }


    public function cars()
    {
        return $this->hasMany(Car::class, 'service_id');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'service_id');
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function types()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}