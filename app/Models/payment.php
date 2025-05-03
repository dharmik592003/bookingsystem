<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\booking;
class payment extends Model
{
   protected $fillable = [
        'booking_id',
        'payment_status',
        'value',
        'description',
    ];

    public function booking()
    {
        return $this->belongsTo(booking::class, 'booking_id');
    }
    public function sendpayment()
    {
        return $this->hasone(booking::class, 'id');
    }
}
