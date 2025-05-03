<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class country extends Model
{
    public function findcountry(){
       
        return $this->hasOne(User::class,'id');
    }
    public function getcountry(){
       
        return $this->belongsTo(agency::class);
    }

    public function getcountryname(){
       
        return $this->hasOne(service::class);
    }

    public function getUsers(){
        return $this->hasMany(User::class, 'country_id');
    }
}
