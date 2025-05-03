<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class yacht extends Model
{
    public function get_service()
    {

        return $this->hasMany(Service::class, 'id');
    }
    public function get_type()
    {
        
        return $this->belongsTo(type::class, 'type_id');
    }
    public function type()
    {
        
        return $this->belongsTo(type::class, 'type_id');
    }
}
