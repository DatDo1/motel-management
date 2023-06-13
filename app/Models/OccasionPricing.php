<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OccasionPricing extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'time',
        'created_at',
        'updated_at',
        'deleted_at',
        'delete_flag',
    ];
    public function room_types(){
        return $this->belongsToMany(RoomType::class, 'occasion_pricing__room_types');
    }
}
