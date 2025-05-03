<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function agencies()
    {
        return $this->hasMany(Agency::class, 'state_id');
    }
    public function services()
    {
        return $this->hasMany(Service::class, 'state_id');
    }
    public function userstate(){
        return $this->hasMany(User::class,'state_id');
    }
}
