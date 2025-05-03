<?php

namespace App;

enum Status: string
{
    case APPROVED = 'APPROVED';
    case PENDING = 'PENDING';
    case DECLINE = 'DECLINE';

public function getstatus():string{
$label =[
self::APPROVED => 'approved',
self::PENDING => 'pending',
self::DECLINE => 'decline'];
return $label[$this->value];
} 

}
