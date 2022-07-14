<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisers', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('name');
            $table->text('about');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('facebook');
            $table->string('twitter');
            $table->string('logo_path')->nullable();
            $table->boolean('is_email_confirmed')->default(0);

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
        Schema::dropIfExists('organisers');
    }
}
