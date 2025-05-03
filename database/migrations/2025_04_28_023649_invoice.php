<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('booking_id'); // Foreign key to bookings table
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->unsignedBigInteger('service_id'); // Foreign key to services table
            $table->unsignedBigInteger('type_id'); // Foreign key to types table
            $table->decimal('bill', 10, 2); // Total bill amount
            $table->integer('days')->nullable(); // Number of days for the booking
            $table->integer('total_hours')->nullable(); // Total hours for the booking
            $table->decimal('discount', 10, 2)->nullable(); // Discount applied
            $table->json('additional_info')->nullable(); // Additional information (e.g., guests, pets, etc.)
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
