<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\booking;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function getcustomer(){
        return $this->hasMany(booking::class,'id');
    }

    public function state(){
        return $this->belongsTo(state::class,'id');
    }
    public function city(){
        return $this->belongsTo(city::class,'id');
    }
    public function country(){
        return $this->belongsTo(country::class,'id');
    }
    public function agencytypeuser(){
        return $this->hasOne(agency::class,'user_id');
    }

    public function associate(){
        return $this->hasOne(associate::class,'id');
    }
 
    
}
