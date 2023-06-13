<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'total_price',
        'payment_method',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'delete_flag',
        'employee_id'
    ];

    public function employee(): HasOne{
        return $this->hasOne(Employee::class, 'employees');
    }
}
