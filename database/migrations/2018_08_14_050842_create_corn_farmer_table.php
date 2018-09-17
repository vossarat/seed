<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCornFarmerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corn_farmer', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('corn_id')->unsigned()->index();
			$table->foreign('corn_id')->references('id')->on('corns')->onDelete('cascade');
			$table->integer('farmer_id')->unsigned()->index();
			$table->foreign('farmer_id')->references('id')->on('farmers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corn_farmer');
    }
}
