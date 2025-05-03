<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'service_id',
        'type_id',
        'bill',
        'days',
        'total_hours',
        'discount',
        'additional_info',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
