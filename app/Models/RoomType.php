<?php

namespace App\Models;

use App\Models\OccasionPricing_RoomType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class RoomType extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',	
        'name',	
        'description',	
        'created_at',	
        'updated_at',	
        'delete_flag',	
        'deleted_at'
    ];
    public function rooms(){
        return $this->hasMany(Room::class);
    }
    public function occasion_pricings(){
        return $this->belongsToMany(OccasionPricing::class, 'room_type__occasion_pricing', 'room_type_id', 'occasion_pricing_id')->withPivot('real_price');
    }

}
