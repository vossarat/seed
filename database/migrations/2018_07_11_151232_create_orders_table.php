<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
   			$table->longText('description');
   			$table->smallInteger('count');
   			$table->decimal('price', 15, 2);
   			
   			$table->boolean('auction'); // торг
   			
   			$table->integer('user_id')->unsigned()->index()->nullable();
   			$table->foreign('user_id')->references('id')->on('users');
   			
   			$table->integer('corns_id')->unsigned()->index()->nullable();
   			$table->foreign('corns_id')->references('id')->on('corns_id');
            
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
        Schema::dropIfExists('orders');
    }
}
