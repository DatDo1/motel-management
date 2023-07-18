<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',	
        'name',	
        'price',	
        'facility',
        'created_at',	
        'updated_at',	
        'deleted_at',	
        'delete_flag',	
        'facility_type_id',	
    ];
    public function facility_type(): BelongsToMany{
        return $this->belongsToMany(Facility::class, 'facility_types');
    }
}
