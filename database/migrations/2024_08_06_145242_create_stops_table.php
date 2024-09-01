<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_trip');
            $table->date('day');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('name');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('street');
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->double('lonCountry', 15, 8);
            $table->double('latCountry', 15, 8);
            $table->double('lonCity', 15, 8)->nullable();
            $table->double('latCity', 15, 8)->nullable();
            $table->double('lonStreet', 15, 8)->nullable();
            $table->double('latStreet', 15, 8)->nullable();
            $table->string('foods')->nullable();
            $table->string('curiosities')->nullable();
            $table->timestamps();

            $table->foreign('id_trip')->references('id')->on('trips')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stops');
    }
};
