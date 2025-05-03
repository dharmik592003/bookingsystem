<?php

namespace App\Models;

use App\Models\User;
use App\Models\Service;
use App\Models\agency;
use App\payment_status;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'agency_id',
        'booking_date',
        'start_time',
        'end_time',
        'status',
        'total_amount',
        'cost',
        'quantity',
        'commission_rate',
        'commission_amount',
        'agency_payout',
        'payment_status',
        'payment_method',
        'transaction_id',
        'notes'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id')->with('types', 'category');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agency()
    {
        return $this->belongsTo(agency::class, 'agency_id');
    }

    // Calculate commission (default 20%)
    public function calculateCommission()
    {
        $this->commission_rate = $this->commission_rate ?? 20;
        $this->commission_amount = $this->total_amount * ($this->commission_rate / 100);
        $this->agency_payout = $this->total_amount - $this->commission_amount;
    }

    // Calculate profit (total_amount - cost)
    public function getProfitAttribute()
    {
        return $this->total_amount - $this->cost;
    }

    public function getPaymentStatusAttribute($value)
    {
        return $this->belongsTo(payment_status::class, 'id');
    }

    public function payment()
    {
        return $this->belongsTo(payment::class, 'payment_id');
    }
}