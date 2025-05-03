<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class servicecategory extends Model
{
    protected $fillable=[
        "name",
        "price",
        "desc",
        'image'
       ];

public function getcategory(){
    return $this->hasone(service::class,'id');
}


public function getservices(){
    return $this->hasMany(service::class,'category_id')->with('agency','country','state','city');
}
public function getagency(){
    return $this->belongsToMany(service::class,'id');
}
    }
