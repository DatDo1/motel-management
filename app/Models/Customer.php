<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'credit_card',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'delete_flag',
        'user_id'
    ];
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
