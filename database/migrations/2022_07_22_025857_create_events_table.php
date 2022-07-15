<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');
            $table->string('location')->nullable();
            $table->text('description');

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->dateTime('on_sale_date')->nullable();

            $table->string("currency")->default("EUR");

            $table->unsignedBigInteger('organiser_id');
            $table->foreign('organiser_id')->references('id')->on('organisers');

            $table->string('location_address', 355)->nullable();
            $table->string('location_address_line_1', 355);
            $table->string('location_address_line_2', 355);
            $table->string('location_country')->nullable();
            $table->string('location_country_code')->nullable();
            $table->string('location_state');
            $table->string('location_post_code');
            $table->string('location_street_number')->nullable();
            $table->string('location_lat')->nullable();
            $table->string('location_long')->nullable();
            $table->string('location_google_place_id')->nullable();

            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
