<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    protected $fillable =[
        'service_photos'
    ];


    
  // Type model
// Type model
public function stays()
{
    return $this->hasMany(Stay::class, 'type_id', 'id');
}


    public function cars()
    {
  

        return $this->hasMany(Car::class, 'id');
    }
    public function get_yacht()
    {
        return $this->hasMany(Yacht::class, 'id');
    }
    public function get_charter()
    {
        return $this->hasMany(Charter::class, 'id');
    }
    public function get_type()
    {
        return $this->hasMany(Service::class, 'type_id');
    }
    public function get_service()
    {

        return $this->hasMany(Service::class, 'type_id');
    }
}
