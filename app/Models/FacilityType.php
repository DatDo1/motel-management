<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacilityType extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
'        delete_flag'
    ]; 
    public function facilities(): HasMany{
        return $this->hasMany(Facility::class, 'facilities');
    }
}
