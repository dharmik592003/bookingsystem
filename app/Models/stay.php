<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stay extends Model
{
    protected $fillable = [
        'name',
        'service_id',
        'category_id',
        'type_id',
        'beds',
        'baths',
        'guests',
        'amenities',
        'agency_id'
    ];

    public function get_service()
    {

        return $this->hasMany(Service::class, 'id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
    
    
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }



}
