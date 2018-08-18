<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index()->nullable();
   			$table->foreign('user_id')->references('id')->on('users');
   			
   			$table->string('title')->nullable();
   			$table->string('fio')->nullable();
   			$table->integer('volume')->nullable(); // объем  продукции
   			
   			$table->integer('region_id')->unsigned()->index()->nullable();
   			$table->foreign('region_id')->references('id')->on('regions');
            
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
        Schema::dropIfExists('farmers');
    }
}
