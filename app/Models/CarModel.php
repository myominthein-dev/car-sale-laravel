<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarModel extends Model
{
    /** @use HasFactory<\Database\Factories\CarModelFactory> */
    use HasFactory;

    protected $fillable = [
        'maker_id',
        'name'
    ];

    public $timestamps = false;

    function maker ():BelongsToMany {
        return $this->belongsToMany(Maker::class);
    }

    function cars ():HasMany {
        return $this->hasMany(Car::class);
    }

}
