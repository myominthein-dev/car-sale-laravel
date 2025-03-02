<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory;

    protected $fillable = [
        'maker_id',
        'model_id',
        'year',
        'price',
        'vin',
        'mileage',
        'car_type_id',
        'fuel_type_id',
        'user_id',
        'city_id',
        'address',
        'phone',
        'description',
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    function maker ():BelongsTo {
        return $this->belongsTo(Maker::class);
     }

     function carType ():BelongsTo {
        return $this->BelongsTo(CarType::class);
     }

     function fuelType ():BelongsTo {
        return $this->BelongsTo(FuelType::class);
     }

     function carModel ():BelongsTo {
        return $this->BelongsTo(CarModel::class,'model_id','id');
     }

     function user ():BelongsTo {
        return $this->belongsTo(User::class);
     }

     function favouredUsers () : BelongsToMany {
        return $this->belongsToMany(User::class,'favourite_cars');
     }

     function carFeature () :HasOne {
        return $this->hasOne(CarFeature::class,'car_id','id');
     }

     function carImage () : HasMany {
        return $this->hasMany(CarImage::class);
     }
     function primaryImage () : hasOne {
      return $this->hasOne(CarImage::class);
     }

     function city () : BelongsTo {
      return $this->belongsTo(City::class);
     }

     function favouriteByUser(): HasOne {
      return $this->hasOne(FavouriteCar::class)
          ->when(Auth::check(), function ($query) {
              $query->where('user_id', Auth::id());
          }, function ($query) {
              return $query->whereRaw('0=1'); // Ensures no results are returned on public pages
          });
  }
}
