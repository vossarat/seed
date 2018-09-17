<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmerRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_region', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('region_id')->unsigned()->index();
			$table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
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
        Schema::dropIfExists('farmer_region');
    }
}
