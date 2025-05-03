<?php

namespace App;

enum service_booking_type: string
{
    case HOURLY = 'hourly';
    case DAILY = 'daily';
    case PERNIGHT = 'night';
    case DISATNCEBASE = 'distancebase';

    public function getBookingType(): string
    {
        $label = [
            self::HOURLY => 'hourly',
            self::DAILY => 'daily',
            self::PERNIGHT => 'night',
            self::DISATNCEBASE => 'distancebase'
        ];
        return $label[$this->value];
    }
}
{

}
