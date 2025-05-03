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
        Schema::create('customerbookings', function (Blueprint $table) {
            $table->timestamps();
            $table->id();
            $table->string('customer_id');
            $table->string('service_id');
            $table->date('from');
            $table->date('to');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('customerbookins', function (Blueprint $table) {
            $table->droptimestamps();});
    }
};
