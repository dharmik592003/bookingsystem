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
        Schema::create('type', function (Blueprint $table) {
            $table->timestamps();
            $table->id();
            $table->string('name');
            $table->string('desc');
            $table->string('price');
            $table->time('checkin');
            $table->time('checkout');
            $table->time('checkin');
            $table->time('checkout');
            $table->time('checkin');
            $table->time('checkout');
            $table->time('checkin');
            $table->time('checkout');
            $table->string('booking_type');
            $table->integer('booking_time');
            $table->integer('agency_id');
            $table->integer('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        {  Schema::create('type', function (Blueprint $table) {
            $table->droptimestamps();});
            
        }
    }
};
