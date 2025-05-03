<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class charter extends Model
{
    public function get_service()
    {

        return $this->belongs(Service::class, 'id');
    }
    public function type()
    {

        return $this->belongsTo(type::class, 'type_id');
    }
}
