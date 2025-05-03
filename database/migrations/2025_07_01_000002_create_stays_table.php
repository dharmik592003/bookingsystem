<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaysTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('type_id');
            $table->integer('beds')->nullable();
            $table->integer('baths')->nullable();
            $table->integer('guests')->nullable();
            $table->text('amenities')->nullable();
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('servicecategory')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stays');
    }
}
