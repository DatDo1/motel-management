<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'credit_card',
        'user_id',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'users');
    }
    public function invoices(): HasMany{
        return $this->hasMany(Invoice::class, 'invoices');
    }
}
