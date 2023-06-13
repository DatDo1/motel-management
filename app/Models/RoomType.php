<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',	
        'name',	
        'people_quantity',	
        'bed_type',	
        'description',	
        'created_at',	
        'updated_at',	
        'delete_flag',	
        'deleted_at'
    ];
    public function rooms(){
        return $this->hasMany(Room::class, 'rooms');
    }
    public function occasion_pricings(){
        return $this->belongsToMany(OccasionPricing::class, 'occasion_pricing__room_types');
    }
}
