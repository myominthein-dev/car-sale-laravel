<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_features', function (Blueprint $table) {
           
            $table->foreignId("car_id")->constrained("cars")->onDelete('cascade');
            $table->boolean("abs")->default(false);
            $table->boolean("air_conditioning")->default(false);
            $table->boolean("power_windows")->default(false);
            $table->boolean("power_door_locks")->default(false);
            $table->boolean("cruise_control")->default(false);
            $table->boolean("bluetooth_connectivity")->default(false);
            $table->boolean("remote_start")->default(false);
            $table->boolean("gps_navigation")->default(false);
            $table->boolean("heater_seats")->default(false);
            $table->boolean("climate_control")->default(false);
            $table->boolean("rear_parking_sensors")->default(false);
            $table->boolean("leather_seats")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_features');
    }
};
