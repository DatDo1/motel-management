<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBooking extends Model
{
    use HasFactory;
    protected $fillable = [
        'checkin_date',	
        'booking_id',	
        'room_id',	
        'uuid',	
        'checkout_date',	
        'is_available',
        'pay_price',	
        'created_at',	
        'updated_at',	
        'deleted_at',	
        'delete_flag',
    ];
    
}
