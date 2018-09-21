<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCornGostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corn_gost', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corn_id')->unsigned()->index();
			$table->foreign('corn_id')->references('id')->on('corns')->onDelete('cascade');
			$table->integer('gost_id')->unsigned()->index();
			$table->foreign('gost_id')->references('id')->on('gosts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corn_gost');
    }
}
