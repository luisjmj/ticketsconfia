<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('event_id')->index();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $table->string('title');
            $table->text('description');
            $table->decimal('price', 13, 2);

            $table->integer('max_per_person')->nullable()->default(null);
            $table->integer('min_per_person')->nullable()->default(null);

            $table->integer('quantity_available')->nullable()->default(null);
            $table->integer('quantity_sold')->default(0);

            $table->dateTime('start_sale_date')->nullable();
            $table->dateTime('end_sale_date')->nullable();

            $table->tinyInteger('is_paused')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
