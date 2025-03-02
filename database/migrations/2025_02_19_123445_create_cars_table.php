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
        Schema::create('cars', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('maker_id')->constrained('makers');
        $table->foreignId('model_id')->constrained('car_models');
        $table->foreignId('car_type_id')->constrained('car_types');
        $table->foreignId('fuel_type_id')->constrained('fuel_types');
        $table->foreignId('city_id')->constrained('cities');
        $table->integer('year');
        $table->integer('price');
        $table->string('vin', 255);
        $table->integer('mileage');
        $table->string('address', 255);
        $table->string('phone', 45);
        $table->longText('description')->nullable();
        $table->timestamps();
        $table->softDeletes();
        $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
