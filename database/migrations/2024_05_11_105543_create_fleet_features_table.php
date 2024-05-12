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
        Schema::create('fleet_features', function (Blueprint $table) {
            $table->UUID('id')->primary();

            $table->string('feature_name')->nullable();
            $table->uuid('fleet_id');
            $table->foreign('fleet_id')->references('id')->on('fleets')->onDelete('cascade');

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
        Schema::dropIfExists('fleet_features');
    }
};