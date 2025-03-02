<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavouriteCar extends Model
{
    /** @use HasFactory<\Database\Factories\FavouriteCarFactory> */
    use HasFactory;
    protected $fillable = ['user_id','car_id'];
    public $timestamps = false;

    public function user () : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function car () : BelongsTo {
        return $this->belongsTo(Car::class);
    }
}
