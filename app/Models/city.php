<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'state_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function agencies()
    {
        return $this->hasMany(Agency::class, 'city_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'city_id');
    }
    public function usercity(){
        return $this->hasMany(User::class,'city_id');
    }
}
