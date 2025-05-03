<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class car extends Model
{
    protected $fillable = ['name'];
    public function get_service()
    {
        return $this->hasMany(Service::class, 'id');
    }
    public function service()
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
    public function get_agency()
    {
        return $this->hasMany(agency::class, 'agency_id');
    }
}
