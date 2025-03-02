<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarFeature extends Model
{
    /** @use HasFactory<\Database\Factories\CarFeatureFactory> */
    use HasFactory;

    protected $fillable = [
        'car_id', 'abs', 'air_conditioning', 'power_windows', 'power_door_locks', 
        'cruise_control', 'bluetooth_connectivity', 'remote_start', 'gps_navigation', 
        'heater_seats', 'climate_control', 'rear_parking_sensors', 'leather_seats'
    ];

    protected $casts = [
        'abs' => 'boolean',
        'air_conditioning' => 'boolean',
        'power_windows' => 'boolean',
        'power_door_locks' => 'boolean',
        'cruise_control' => 'boolean',
        'bluetooth_connectivity' => 'boolean',
        'remote_start' => 'boolean',
        'gps_navigation' => 'boolean',
        'heated_seats' => 'boolean',
        'climate_control' => 'boolean',
        'rear_parking_sensors' => 'boolean',
        'leather_seats' => 'boolean'
    ];
    
    function car () :BelongsTo {
        return $this->belongsTo(Car::class);
    }


    public $timestamps = false;
}
