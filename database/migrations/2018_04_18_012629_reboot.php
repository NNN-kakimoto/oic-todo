<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reboot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
				//
				Schema::create('trips', function(Blueprint $table){
					$table->increments('id');
					$table->string('name');
					$table->string('target')->nullable();
					$table->integer('total_cost')->default(0);
					$table->boolean('is_finished')->default(false);
					$table->timestamps();
				});
				Schema::create('items', function (Blueprint $table) {
					$table->increments('id');
					$table->string('name');
					$table->integer('status');
					$table->integer('cost')->default(0);
					$table->integer('trip_id');
					$table->boolean('is_finished')->default(false);
					$table->timestamps();
	
					//$table->foregin('trip_id')->references('id')->on('trips');
				});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
				//
			Schema::dropIfExists('trips');
			Schema::dropIfExists('items');
    }
}
