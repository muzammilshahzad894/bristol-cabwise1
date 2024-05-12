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
        Schema::create('bookings', function (Blueprint $table) {
            $table->UUID('id')->primary();
            $table->string('request_type');
            $table->string('payment_type');
            $table->text('pickup_address');
            $table->text('destination_address');
            $table->dateTime('pickup_date_time');
            $table->uuid('fleet_id');
            $table->foreign('fleet_id')->references('id')->on('fleets')->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('no_of_passengers');
            $table->string('child_seat');
            $table->string('suitcases');
            $table->string('hand_luggage');
            $table->string('payment_amount');
            $table->string('payment_status')->default('pending');
            $table->string('booking_status')->default('pending');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
