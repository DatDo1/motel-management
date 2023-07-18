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
        'start_date',
        'basic_salary',
        'created_at',
        'updated_at',
        'deleted_at',
        'delete_flag',
        'user_id'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function invoices(): HasMany{
        return $this->hasMany(Invoice::class);
    }
}
