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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->after('id');
            $table->unsignedBigInteger('car_id');
            $table->string('car')->after('user_id');
            $table->decimal('price', 10, 2)->after('car');
            $table->string('image')->nullable()->after('price');
            $table->date('pickup_date')->after('image');
            $table->date('return_date')->after('pickup_date');
            $table->string('payment_method')->after('return_date');
            $table->json('payment_details')->nullable()->after('payment_method');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['car_id']);
        });
        Schema::dropIfExists('payments');
    }
};