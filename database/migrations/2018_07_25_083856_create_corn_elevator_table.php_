<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCornElevatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corn_elevator', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('corn_id')->unsigned()->index();
			$table->foreign('corn_id')->references('id')->on('corns')->onDelete('cascade');
			$table->integer('elevator_id')->unsigned()->index();
			$table->foreign('elevator_id')->references('id')->on('elevators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corn_elevator');
    }
}
