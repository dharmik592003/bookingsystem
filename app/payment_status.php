<?php

namespace App;

enum payment_status : string
{
    case DONE = 'done';
    case PENDING = 'PENDING';
    case DECLINE = 'DECLINE';
    case REFUNDED = 'REFUNDED';

    public function get_payment_status(): string
    {
        $label = [
            self::DONE => 'done',
            self::PENDING => 'pending',
            self::DECLINE => 'decline',
            self::REFUNDED => 'refunded',
        ];
        return $label[$this->value];
    }
}

