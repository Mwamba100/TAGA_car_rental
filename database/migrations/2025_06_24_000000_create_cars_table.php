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
            $table->string('vin')->unique(); // Vehicle Identification Number
            $table->string('slug')->unique();
            $table->string('make');
            $table->string('model');
            $table->year('year');
            $table->string('license_plate')->unique();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('color')->nullable();
            $table->string('fuel_type')->nullable(); // e.g., Petrol, Diesel, Electric
            $table->integer('mileage')->nullable(); // in kilometers or miles
            $table->integer('seating_capacity')->default(5); // Default to 5 seats
            $table->string('transmission')->default('automatic'); // e.g., automatic,
            $table->string('category')->default('sedan'); // e.g., sedan, SUV, truck
            $table->string('features')->nullable(); // JSON or comma-separated list of features
            $table->decimal('rental_price_per_day', 8, 2);
            $table->boolean('available')->default(true);
            $table->timestamps();
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