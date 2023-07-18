<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'uuid',	
        'name',	
        'floor',	
        'is_available',	
        'image',	
        'reference_price',	
        'area',	
        'adult_quantity',
        'children_quantity',
        'created_at',	
        'updated_at',	
        'deleted_at',	
        'delete_flag',	
        'room_type_id'
    ];
    public function room_type(){
        return $this->belongsTo(RoomType::class);
    }
}
