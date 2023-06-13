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
        'start_date',
        'basic_salary',
        'user_id',
    ];
    public function bookings(): HasMany{
        return $this->hasMany(Booking::class, 'bookings');
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'users');
    }
}
