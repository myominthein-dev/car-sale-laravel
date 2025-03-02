<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FuelType extends Model
{
    /** @use HasFactory<\Database\Factories\FuelTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
    function car ():HasMany {
        return $this->hasMany(Car::class);
    }
}
