<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeElevatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_elevator', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('elevator_id')->unsigned()->index();
			$table->foreign('elevator_id')->references('id')->on('elevators')->onDelete('cascade');
			$table->integer('attribute_id')->unsigned()->index();
			$table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
			$table->string('attr_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_elevator');
    }
}
