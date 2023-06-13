<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccasionPricing_RoomType extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',	
        'real_price',	
        'created_at',	
        'updated_at',	
        'deleted_at',	
        'delete_flag',	
        'occasion_pricing_id',	
        'room_type_id'
    ];
   
    
}
