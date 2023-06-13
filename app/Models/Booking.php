<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'room_quantity',
        'people_quantity',
        'other_request',
        'created_at',
        'updated_at',
        'deleted_at',
        'delete_flag',
        'customer_id'
    ];
    public function customer(): BelongsToMany{
        return $this->belongsToMany(Customer::class, 'customers');
    }
}
