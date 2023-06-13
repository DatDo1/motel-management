<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',	
        'name',	
        'floor',	
        'is_available',	
        'image',	
        'reference_price',	
        'area',	
        'created_at',	
        'updated_at',	
        'deleted_at',	
        'delete_flag',	
        'room_type_id'
    ];
    public function room_type(){
        return $this->belongsTo(RoomType::class, 'room_types');
    }
}
