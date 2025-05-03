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
        Schema::create('services', function (Blueprint $table) {
            $table->timestamps();
            $table->id();
            $table->string('name');
            $table->string('desc');
            $table->text('comapny_details');
            $table->string('address');
            $table->string('number');
            $table->string('email');
            $table->string('service_images');
            $table->string('category_id');
            $table->string('agency_id');
            $table->string('price');
            $table->string('type_id');
            $table->time('booking_start');
            $table->time('booking_end');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {  Schema::create('services', function (Blueprint $table) {
        $table->droptimestamps();});
        
    }
};
