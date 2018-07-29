<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElevatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elevators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');            
            $table->decimal('price', 15, 2);
            
            $table->integer('user_id')->unsigned()->index()->nullable();
   			$table->foreign('user_id')->references('id')->on('users');   			
   			
   			$table->integer('town_id')->unsigned()->index()->nullable();
   			$table->foreign('town_id')->references('id')->on('towns');
   			
   			$table->string('username');
   			$table->longText('description');
   			
   			$table->string('email');
            $table->string('phone', 18)->nullable();
            $table->string('whatsapp', 18)->nullable();
            
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
        Schema::dropIfExists('elevators');
    }
}
